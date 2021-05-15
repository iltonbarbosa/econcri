# Sistema para cadastro de artistas

Desenvolvido com CodeIgniter 4, o sitema Econcri está na sua primeira versão, aliás pode-se dizer um protótipo ainda. Tem funções para cadastro de artitas, por categorias. As categorias "Banda" e "cantor", possui campos a mais que são exibidos no formulário de cadastro, quando se seleciona uma destas categorias.
Todos os campos necessários para conclusão do cadastro, estão distribuídos em várias telas, de modo a não desencorajar o usuário se todos os campos estivessem em uma única tela. Na primeira tela o usuário seleciona a categoria e na tela seguinte preenche as informações básicas do cadastros, nas telas seguintes são informações complementares, sendo a última tela o mapa onde o usuário marcará em que localização se encontra seu projeto.
Para cadastrar um artista, o usuário precisa cadastrar-se primeiro como usuário do sistema, onde é pedido somente o nome do usuário, o e-mail e a senha. Uma mensagem é enviada para o e-mail do usuário confirmando o cadastro e informando sobre o próximo passo.
A partir deste cadastro inicial, o usuário poderá cadastrar quantos artistas quiser.

##Tela inicial
A tela inicial apresenta um mapa com pontos marcados dos cadastros já realizados. Como foi desenvolvido com foco nos artistas de Brasília, o mapa tem sua localização inicial no centro de Brasília.
Os usuários poderão clicar nos pontos marcados e acessar informações básicas dos cadastros. No menu lateral tem um link que também possibilita ver a lista dos cadastros já realizados, bem como um menu para selecionar a exibição dos pontos por categorias.

##Novas funcionalidades a serem desenvolvidas
Está previsto que o sistema tenha novas funcionalidades, tais como:
<!--ts-->
* Busca por palavra-chave.
* Na tela em que se marca o ponto no mapa da localização do artista, é necessário arrastar um pontinho vermelho para a posição que indica a localização do artista. O ideal é que o ponto fosse exibido na localização do artista a partir de um clique do mouse.
* Módulo para o usuário montar orçamento para projetos: o sistema listará itens básicos que um projeto deverá ter, conforme for o tipo de projeto que pretende executar e se o tipo estiver contemplado nos tipos já pre-estabelecidos, tais como: realizar evento com shows ao vivo, evento de feira, evento em locais fechados...
* Módulo para o usuário montar um projeto: - ter um passo-a-passo para se montar um projeto. O usuário vai preenchendo as informações e no final o sistema gera um arquivo com uma estrutura básica e as informações já acrescentadas.
* Chat on-line
* Sistema de pontuação para, por exemplo, cadastros completos (preenchidos 100%), agendas atualizadas, uso dos módulos, etc.
* Módulo de contrato: fechamento de contrato com bares, ou produtores de evento.
* Exibição de anúncios para usuários que não optarem pela versão PRO.
<!--te-->

A idéia é que o acesso a alguns destes módulos seja pago.


##Banco de dados
O banco é MySQL e o script está na pasta Docs, na raiz do projeto.
Não desenvolvi o arquivo de migração conforme recomenda o CodeIgniter.

Coloquei nesta pasta também os prints de algumas telas.

Contatos: sistemaeconcri@gmail.com

