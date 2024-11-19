<img src="https://github.com/anamota13/ArtSync/blob/main/Logo_ArtSync_GitHub.png" alt="ArtSync Logo" width="80"/> 

# ArtSync: Sistema Web Integrado de Gestão para Museus e Galerias de Arte


&nbsp;&nbsp;&nbsp;&nbsp; O **ArtSync** é uma plataforma inovadora desenvolvida para facilitar o gerenciamento de coleções de arte em museus e galerias. O sistema foi projetado para **organizar**, **administrar** e **divulgar** obras de arte de maneira eficiente, permitindo que tanto curadores quanto visitantes tenham uma experiência fluida e acessível. Além disso, o ArtSync promove a **democratização do acesso à arte** ao disponibilizar as coleções online, conectando pessoas e culturas.


## **Sumário**
1. Principais Funcionalidades
2. Tecnologias Utilizadas
3. Objetivo do Projeto
4. Configurações para rodar localmente
5. Prototipagem
6. Artigos e Referência

## ⚙️ Funcionalidades  

#### Para Usuários Não Logados  
- **Visualização de Coleções**: Permite explorar online as coleções e exposições, oferecendo um primeiro contato com as obras disponíveis.  
- **Recebimento de Newsletter**: Interessados podem se inscrever para receber atualizações e novidades sobre o ArtSync e as coleções.  

#### Para Usuários Logados  
- **Agendamento de Visitas**: Usuários podem agendar visitas a museus ou galerias, escolhendo datas e horários disponíveis.  
- **Notificações de Agendamento**: Após o agendamento, o usuário recebe uma notificação por e-mail com os detalhes da visita.  
- **Visualização de Coleções**: Acesso às mesmas coleções e exposições disponíveis para usuários não logados.  
- **Recebimento de Newsletter**: Continuação do recebimento de novidades e atualizações via e-mail.  

#### Para Administradores  
&nbsp;&nbsp;&nbsp;&nbsp; Além de todas as funcionalidades mencionadas, os administradores têm acesso a:  
- **Gerenciamento de Obras**: Permite cadastrar, editar e excluir obras de arte com facilidade, garantindo que o acervo esteja sempre atualizado e organizado. Essa funcionalidade melhora a curadoria e facilita a exposição de novos itens. Com essa organização, os administradores podem controlar as estatísticas relacionadas às visitas, assegurando uma análise precisa do desempenho e visibilidade.

#### Notificações Automatizadas: Envio de e-mails com confirmações de agendamento e atualizações. 

## 👨🏻‍💻 Tecnologias Utilizadas

- **HTML**: Estruturação do conteúdo da página, permitindo uma base sólida para a interface.
- **CSS**: Estilização da interface, garantindo um design atraente e responsivo.
- **JavaScript**: Interatividade no frontend, como calendários dinâmicos e manipulação de eventos do usuário.
- **PHP**: Linguagem de script do lado do servidor, utilizada para a lógica de backend, incluindo o gerenciamento de sessões, autenticação de usuários e comunicação com o banco de dados.
- **MySQL**: Banco de dados relacional utilizado para armazenar informações sobre obras de arte, usuários e agendamentos, permitindo consultas eficientes e integridade dos dados.
- **XAMPP**: Ambiente de desenvolvimento local que facilita a configuração e execução do projeto sem a necessidade de instalação separada de cada componente.
- **PHPMailer**: Biblioteca PHP utilizada para o envio de e-mails, garantindo comunicação eficaz com os usuários, como confirmações de agendamentos e newsletters.


## 🎯 Objetivo do Projeto

&nbsp;&nbsp;&nbsp;&nbsp; O objetivo do **ArtSync** é revolucionar a forma como museus e galerias gerenciam suas coleções e interagem com os visitantes. A plataforma busca democratizar o acesso à arte, permitindo que usuários de diferentes origens e locais explorem exposições e obras de arte de forma online e intuitiva.

&nbsp;&nbsp;&nbsp;&nbsp; Com a implementação de funcionalidades como agendamento de visitas, notificações automatizadas e gerenciamento eficiente de obras, o ArtSync visa:

- **Facilitar a Gestão Cultural**: Proporcionar uma ferramenta robusta para administradores e curadores, permitindo uma gestão mais organizada e eficiente das coleções e exposições.
- **Aumentar a Visibilidade das Obras**: Tornar as coleções acessíveis a um público mais amplo, independentemente da localização física dos museus e galerias.
- **Promover a Interação do Usuário**: Criar uma experiência de usuário envolvente e dinâmica, incentivando os visitantes a se conectarem mais profundamente com as obras de arte e as instituições culturais.
- **Automatizar Processos**: Reduzir a carga administrativa por meio da automação de tarefas como agendamentos e comunicação com os usuários, resultando em economias operacionais significativas.

&nbsp;&nbsp;&nbsp;&nbsp; Dessa forma, o ArtSync não apenas otimiza a operação das instituições culturais, mas também contribui para uma maior valorização da arte e uma experiência enriquecedora para todos os envolvidos.


## 🔧 Configuração do Sistema (Rodar Local)

Atente-se ao guia caso queira configurar o sistema localmente usando **XAMPP** e os recursos fornecidos no repositório.

---

## 🛠️ **Requisitos**

- [Baixe e instale o XAMPP](https://www.apachefriends.org)
- Arquivo `.sql` com o esquema do banco de dados (disponível no repositório)
- Biblioteca **PHPMailer** (disponível no repositório)

---

## 🚀 **Passos para Configurar o Sistema**

### 1️⃣ **Instalação e Inicialização do XAMPP**
1. Baixe e instale o [XAMPP](https://www.apachefriends.org).
2. Abra o **Painel de Controle do XAMPP**.
3. Inicie os serviços **Apache** e **MySQL** clicando em **Start**.

---

### 2️⃣ **Configuração do Banco de Dados**
1. Acesse o [phpMyAdmin](http://localhost/phpmyadmin).
2. Clique na aba **Importar**.
3. Selecione o arquivo `.sql` do banco de dados localizado no repositório.
4. Clique em **Executar** para importar o esquema do banco.

---

### 3️⃣ **Configuração do PHPMailer**
1. Copie a pasta `PHPMailer` do repositório para o diretório raiz do sistema no servidor local (ex.: `htdocs`).
2. Edite o arquivo `agendar.action`, `newsletter.action` e `resetar_senha_action.php`:
- Configure as credenciais do e-mail (usuário, senha, e servidor SMTP).
- Exemplo:
  ```php
  $mail->Host = 'smtp.exemplo.com';
  $mail->Username = 'seu_email@exemplo.com';
  $mail->Password = 'sua_senha';
  ```

---

### 4️⃣ **Configuração do Sistema**
1. **Se necessário**, edite os arquivo que possuem a conexão com o banco (ex: db.php) no diretório do sistema:
- Configure as credenciais de acesso ao banco de dados:
  ```php
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'artsync_pi';
  ```
2. Salve o arquivo e teste a conexão ao banco.

---

## 📝 **Observações**
- Certifique-se de que o serviço **MySQL** está em execução no XAMPP antes de acessar o banco de dados.
- Verifique as permissões de acesso ao banco de dados. Se necessário, crie um usuário específico para o sistema.
- Mantenha os arquivos de configuração com permissões adequadas para evitar problemas de segurança.


## 📚 Artigos e Referências

&nbsp;&nbsp;&nbsp;&nbsp; Para embasamento teórico, foi utilizado o artigo de Rute Muchacho, que aborda como "os novos media e, em particular, a internet são um instrumento precioso no processo de comunicação entre o museu e o seu público. A sua utilização como complemento do espaço físico do museu vem facilitar a transmissão da mensagem pretendida e captar a atenção do visitante, possibilitando uma nova visão do objeto museológico" (Muchacho, 2024). Essa perspectiva reforça a importância de um sistema digital como o ArtSync para aprimorar a interação entre museus e seus públicos.

&nbsp;&nbsp;&nbsp;&nbsp; Além disso, foi referenciado o trabalho de Teixeira e Travaglia (2019), que destaca a importância da arte na construção da identidade e da cultura de uma sociedade. Eles afirmam: "Arte e sociedade sempre estiveram intrinsecamente unidas. Nas artes dão-se expressões das diferentes culturas, de sentimentos e emoções, de hábitos de uma civilização, de mensagens, do humano. Sem ela, não conseguiríamos formar nossa própria identidade e não teríamos desenvolvido nossa capacidade de criar." (p. 169)

#### ▶️ Referências

- MUCHACHO, Rute. Museus virtuais: A importância da usabilidade na mediação entre o público e o objecto museológico. SOPCOM: Associação Portuguesa de Ciências da Comunicação, p. 1540-1547, 2005. [Leia o artigo aqui.](https://arquivo.bocc.ubi.pt/pag/muchacho-rute-museus-virtuais-importancia-usabilidade-mediacao.pdf)
- TEIXERA, A.; TRAVAGLIA, Z. Desvalorização da arte na sociedade atual. Convenit Internacional, v. 31, p. 169-176, 2019. [Leia o artigo aqui.](http://www.hottopos.com/convenit31/169-176Amanda.pdf)



