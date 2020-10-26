# vcaixa-tecnospeed
Projeto desenvolvido para seleção na empresa tecnospeed

Você acabou de montar uma loja, porém percebeu que tem dificuldades de administrar seu caixa, a primeira ideia que vem na cabeça é criar sistema que te ajude com isso. Você quer registrar quando recebe algum dinheiro (entrada) ou quando paga alguma conta (saída). Para melhor organização do seu caixa você também precisa criar categorias para que associe a suas movimentações futuras. Para que se lembre futuramente também precisava registrar uma pequena descrição das movimentações.
Após começar utilizar o caixa percebeu que apesar de registrar as entradas e saídas categorizadas não tinha a mínima ideia do que estava acontecendo na loja, decidiu então criar uma rota na API que devolvesse um objeto com o resumo da carteira com o saldo total e as movimentações do dia. Sua carteira ficou tão boa que você quer então transformar em um produto e vender um serviço de Caixa Virtual (vcaixa.dev) a outros desenvolvedores que atendem lojas, para que os mesmos não precisem fazer o mesmo esforço que você.

Exercício: Construa uma API que atenda os requisitos citados acima.

vcaixa.dev

 => http://localhost/vcaixa-tecnospeed/api/v1/transacao/movimentar
 
- registrar quando recebe algum dinheiro (entrada);

{     
    "id_cliente": "String",
    "categoria":{"id":"String"},
    "tipo": "1",
    "valor":"Number",
    "descricao":"String"
}

- pagar alguma conta (saída);

{     
    "id_cliente": "String",
    "categoria":{"id":"String"},
    "tipo": "2",
    "valor":"Number",
    "descricao":"String"
}
- registrar uma pequena descrição das movimentações.

- criar categorias para que associe a suas movimentações futuras;

{     
    "nome": "String"
}


criar uma rota na API que devolvesse um objeto com o resumo da carteira com o saldo total e as movimentações do dia.

 => http://localhost/vcaixa-tecnospeed/api/v1/carteira/mostrar/id

***************************************************************************************

{
    saldoTotal: Number,
    movimentacoes: [
        {
            data: Date,
            id: String,
            categoria: { id: String, name: String}
        },
            tipo: String,
            valor: Number,
            descricao: String
        }
    ]
}
