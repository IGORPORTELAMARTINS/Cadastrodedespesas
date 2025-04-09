Relatório do Projeto - Sistema de Cadastro de Despesas

1. Introdução
Este relatório descreve o desenvolvimento de um sistema web para cadastro e gerenciamento de despesas pessoais. O projeto teve como base arquivos fornecidos pelo professor, que serviram de ponto de partida para a estrutura e funcionalidades do sistema.

2. Objetivo do Projeto
O principal objetivo foi criar um sistema funcional e intuitivo para que o usuário pudesse registrar e visualizar suas despesas de maneira organizada, contribuindo para um melhor controle financeiro pessoal.

3. Tecnologias Utilizadas
HTML5 – Para a estruturação das páginas.

CSS3 – Para estilização, responsividade e organização visual.

JavaScript – Para interatividade com o usuário, incluindo formatação de valores e controle de exibição de campos.

PHP – Para envio e processamento dos dados.

MySQL – Como banco de dados para armazenamento das despesas.

Flatpickr – Biblioteca para seleção de datas com melhor usabilidade.

4. Funcionalidades Desenvolvidas
4.1 Cadastro de Despesas
O formulário permite ao usuário registrar informações como o nome da despesa, data, categoria, forma de pagamento, parcelamento (se aplicável), tipo (fixa ou variável) e valor.

4.2 Formatação de Dados
A data é selecionada com auxílio do Flatpickr, garantindo um formato padronizado.

O campo de valor é automaticamente formatado em reais, facilitando a entrada correta pelo usuário.

4.3 Exibição Condicional de Campos
O campo de parcelamento é exibido apenas quando a forma de pagamento selecionada é “Cartão de Crédito”.

4.4 Visualização e Edição
As despesas cadastradas podem ser listadas e editadas por meio de uma interface simples, permitindo a atualização das informações diretamente pelo usuário.

5. Interface e Estilo
A interface foi projetada com um layout limpo e moderno, utilizando a fonte Montserrat e uma paleta de cores suaves. O formulário foi centralizado na tela para melhorar a legibilidade e a experiência do usuário.

6. Considerações Finais
O projeto foi desenvolvido com foco na praticidade de uso e organização das despesas. Apesar de sua simplicidade, representa uma base sólida para futuras melhorias, como:

Implementação de filtros por data ou categoria;

Visualização de dados por meio de gráficos;

Sistema de login com autenticação de usuários;

Adaptação para dispositivos móveis com layout responsivo.