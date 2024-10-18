<?php
session_start();


$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;


include('db.php');


$reservations = [];
try {
    $stmt = $pdo->query("SELECT `data`, `horario` FROM reservas");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $reservations[$row['data']][] = $row['horario'];
    }
} catch (PDOException $e) {
    error_log("Erro ao buscar reservas: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Visitas</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .reserved { background-color: #d3d3d3; cursor: not-allowed; }
        .available { cursor: pointer; }
        .available:hover { background-color: #f0f0f0; }
        .selected { background-color: #c0e0ff; }
        
        #horarios {
            transition: max-height 0.4s ease, opacity 0.4s ease;
            max-height: 0; 
            opacity: 0; 
            overflow: hidden; 
    
        }

        #horarios.show {
            max-height: 500px; 
            opacity: 1; 
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>

    <?php include('header.php'); ?>

<section class="corpo">
<p>&nbsp &nbsp &nbsp Bem-vindo! Aqui, você pode agendar sua visita às nossas exposições. Escolha um dia no calendário e selecione um horário disponível. Horários reservados estarão destacados em cinza. <br> 
&nbsp &nbsp &nbsp &nbspEstamos ansiosos para recebê-lo! Lembre-se de que é necessário estar logado para agendar sua visita.</p>
</section>


    <section class="visitas">
        <div class="calendar">
            <div class="month">
                <button class="prev">&#10094;</button>
                <h2 id="month-name">Agosto 2024</h2>
                <button class="next">&#10095;</button>
            </div>
            <div class="weekdays">
                <div>Dom</div><div>Seg</div><div>Ter</div><div>Qua</div><div>Qui</div><div>Sex</div><div>Sáb</div>
            </div>
            <div class="days" id="days"></div>
        </div>

        <div id="horarios">
            <h3>Horários disponíveis:</h3>
            <div id="horarios-container"></div>
        </div>

        <button id="agendar-btn">AGENDAR</button>
        <div id="mensagem"></div>
    </section>

    <script>
        const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();
        let selectedDay = null;
        let selectedTime = null;

        const reservedTimes = <?php echo json_encode($reservations); ?>;
        const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;

        function renderCalendar() {
            const daysContainer = document.getElementById('days');
            const monthName = document.getElementById('month-name');
            daysContainer.innerHTML = '';

            const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
            const lastDateOfMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            monthName.textContent = `${monthNames[currentMonth]} ${currentYear}`;

            for (let i = 0; i < firstDayOfMonth; i++) {
                daysContainer.appendChild(document.createElement('div'));
            }

            for (let i = 1; i <= lastDateOfMonth; i++) {
                const dayDiv = document.createElement('div');
                dayDiv.textContent = i;
                dayDiv.addEventListener('click', (event) => selectDay(event, i));
                daysContainer.appendChild(dayDiv);
            }
        }

        function selectDay(event, day) {
            selectedDay = day;
            document.querySelectorAll('.days div').forEach(div => div.classList.remove('selected'));
            event.target.classList.add('selected');
            loadAvailableTimes(day);
        }

        function loadAvailableTimes(day) {
            const selectedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const horariosContainer = document.getElementById('horarios-container');
            horariosContainer.innerHTML = '';
            const horariosDiv = document.getElementById('horarios');
            horariosDiv.classList.add('show'); 

            const availableTimes = ['09:00', '10:00', '11:00', '14:00', '15:00', '16:00'];

            availableTimes.forEach(time => {
                const timeDiv = document.createElement('div');
                timeDiv.textContent = time;

                if (reservedTimes[selectedDate] && reservedTimes[selectedDate].includes(time)) {
                    timeDiv.classList.add('reserved');
                    timeDiv.title = 'Horário já reservado';
                } else {
                    timeDiv.classList.add('available');
                    timeDiv.addEventListener('click', (event) => selectTime(event, time));
                }
                horariosContainer.appendChild(timeDiv);
            });
        }

        function selectTime(event, time) {
            selectedTime = time;
            document.querySelectorAll('#horarios-container div').forEach(div => div.classList.remove('selected'));
            event.target.classList.add('selected');
        }

        document.querySelector('.prev').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) { currentMonth = 11; currentYear--; }
            renderCalendar();
        });

        document.querySelector('.next').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) { currentMonth = 0; currentYear++; }
            renderCalendar();
        });

        document.getElementById('agendar-btn').addEventListener('click', () => {
            if (!selectedDay || !selectedTime) {
                document.getElementById('mensagem').textContent = "Por favor, selecione um dia e um horário.";
                return;
            }

            if (isLoggedIn) {
                const selectedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(selectedDay).padStart(2, '0')}`;
                fetch('agendar_action.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `data=${encodeURIComponent(selectedDate)}&horario=${encodeURIComponent(selectedTime)}`,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('mensagem').textContent = data.success;
                    } else {
                        document.getElementById('mensagem').textContent = data.error;
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    document.getElementById('mensagem').textContent = "Erro ao enviar a solicitação.";
                });
            } else {
                document.getElementById('mensagem').textContent = "Você precisa estar logado para agendar.";
            }
        });

        renderCalendar();
    </script>

<footer>
        <div class="container-footer">
            <div class="row-footer">
                <div class="footer-col footer-logo"> 
                    <img src="logo.png" alt="artsync">
                </div>
                
                <div class="footer-col">
                    <h4><b>INSCREVA-SE PARA RECEBER NOSSO NEWSLETTER</b></h4>
                    <div class="form-sub">
                        <form id="newsletter-form" action="newsletter_action.php" method="POST">
                            <input type="email" name="email" placeholder="Digite o seu e-mail" required>
                            <input type="hidden" name="redirect_page" value="<?php echo basename($_SERVER['PHP_SELF']); ?>"> 
                            <button type="submit">Enviar</button>
                        </form>
                    </div>                    
                    <div class="contact-section">
                        <p><i class="fa fa-clock"></i> Das 08:00 às 18:00</p>
                        <p><i class="fa fa-phone"></i> +55 16 99297-1607</p>
                    </div>
    
                    <div class="social-icons">
                        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="mailto:contato@na.na"><i class="fas fa-envelope"></i></a>
                    </div>
    
                    <div class="maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.788034016978!2d-47.403269224983326!3d-20.514913781008914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94b0a650b93c4b5f%3A0xbe0e42f3aa42525c!2sFatec%20Franca%20-%20Faculdade%20de%20Tecnologia%20de%20Franca%20Dr%20Thomaz%20Novelino!5e0!3m2!1spt-BR!2sbr!4v1727284305686!5m2!1spt-BR!2sbr" 
                            width="500vh" height="250vh" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>