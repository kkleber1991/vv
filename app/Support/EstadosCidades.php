<?php

namespace App\Support;

class EstadosCidades
{
    public static $estados = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins'
    ];

    public static $cidades = [
        'AC' => [
            'Rio Branco', 'Cruzeiro do Sul', 'Sena Madureira', 'Tarauacá', 'Feijó',
            'Brasiléia', 'Senador Guiomard', 'Plácido de Castro', 'Xapuri', 'Rodrigues Alves',
            'Acrelândia', 'Epitaciolândia', 'Mâncio Lima', 'Porto Acre', 'Bujari',
            'Marechal Thaumaturgo', 'Jordão', 'Manoel Urbano', 'Porto Walter', 'Santa Rosa do Purus',
        ],
        'AL' => [
            'Maceió', 'Arapiraca', 'Rio Largo', 'Palmeira dos Índios', 'Marechal Deodoro',
            'União dos Palmares', 'Penedo', 'São Miguel dos Campos', 'Coruripe', 'Delmiro Gouveia',
            'Campo Alegre', 'Atalaia', 'Teotônio Vilela', 'Girau do Ponciano', 'Santana do Ipanema',
            'São Luís do Quitunde', 'Pão de Açúcar', 'Pilar', 'Maragogi', 'Porto Calvo',
        ],
        'AP' => [
            'Macapá', 'Santana', 'Laranjal do Jari', 'Oiapoque', 'Porto Grande',
            'Mazagão', 'Pedra Branca do Amapari', 'Vitória do Jari', 'Calçoene', 'Tartarugalzinho',
            'Serra do Navio', 'Ferreira Gomes', 'Cutias', 'Itaubal', 'Pracuúba',
            'Amapá', 'Bailique', 'Maracá', 'Cupixi', 'Abacate da Pedreira',
        ],
        'AM' => [
            'Manaus', 'Parintins', 'Itacoatiara', 'Manacapuru', 'Coari',
            'Tefé', 'Tabatinga', 'Maués', 'Manicoré', 'Humaitá',
            'Lábrea', 'São Gabriel da Cachoeira', 'Borba', 'Autazes', 'Nova Olinda do Norte',
            'Barreirinha', 'Presidente Figueiredo', 'Boca do Acre', 'Benjamin Constant', 'Iranduba',
        ],
        'BA' => [
            'Salvador', 'Feira de Santana', 'Vitória da Conquista', 'Camaçari', 'Juazeiro',
            'Itabuna', 'Lauro de Freitas', 'Ilhéus', 'Jequié', 'Teixeira de Freitas',
            'Alagoinhas', 'Barreiras', 'Porto Seguro', 'Simões Filho', 'Paulo Afonso',
            'Eunápolis', 'Santo Antônio de Jesus', 'Valença', 'Candeias', 'Guanambi',
        ],
        'CE' => [
            'Fortaleza', 'Caucaia', 'Juazeiro do Norte', 'Maracanaú', 'Sobral',
            'Crato', 'Itapipoca', 'Maranguape', 'Iguatu', 'Quixadá',
            'Pacajus', 'Canindé', 'Aquiraz', 'Crateús', 'Russas',
            'Tianguá', 'Aracati', 'Horizonte', 'Icó', 'Pacatuba',
        ],
        'DF' => [
            'Brasília', 'Ceilândia', 'Taguatinga', 'Samambaia', 'Planaltina',
            'Recanto das Emas', 'Águas Claras', 'Gama', 'Santa Maria', 'Guará',
            'Sobradinho', 'Riacho Fundo', 'Paranoá', 'São Sebastião', 'Núcleo Bandeirante',
            'Vicente Pires', 'Cruzeiro', 'Lago Sul', 'Lago Norte', 'Sudoeste/Octogonal',
        ],
        'ES' => [
            'Vitória', 'Vila Velha', 'Serra', 'Cariacica', 'Linhares',
            'Cachoeiro de Itapemirim', 'Colatina', 'Guarapari', 'Aracruz', 'São Mateus',
            'Viana', 'Nova Venécia', 'Barra de São Francisco', 'Domingos Martins', 'Santa Maria de Jetibá',
            'Marataízes', 'Castelo', 'Anchieta', 'Baixo Guandu', 'Itapemirim',
        ],
        'GO' => [
            'Goiânia', 'Aparecida de Goiânia', 'Anápolis', 'Rio Verde', 'Luziânia',
            'Águas Lindas de Goiás', 'Valparaíso de Goiás', 'Trindade', 'Formosa', 'Novo Gama',
            'Senador Canedo', 'Itumbiara', 'Catalão', 'Jataí', 'Planaltina',
            'Caldas Novas', 'Cristalina', 'Mineiros', 'Inhumas', 'Quirinópolis',
        ],
        'MA' => [
            'São Luís', 'Imperatriz', 'São José de Ribamar', 'Timon', 'Caxias',
            'Paço do Lumiar', 'Açailândia', 'Bacabal', 'Balsas', 'Codó',
            'Barra do Corda', 'Pinheiro', 'Santa Inês', 'Chapadinha', 'Santa Luzia',
            'Grajaú', 'Itapecuru-Mirim', 'Pedreiras', 'Zé Doca', 'Coroatá',
        ],
        'MT' => [
            'Cuiabá', 'Várzea Grande', 'Rondonópolis', 'Sinop', 'Tangará da Serra',
            'Cáceres', 'Sorriso', 'Lucas do Rio Verde', 'Barra do Garças', 'Primavera do Leste',
            'Alta Floresta', 'Pontes e Lacerda', 'Nova Mutum', 'Campo Verde', 'Guarantã do Norte',
            'Colíder', 'Juína', 'Paranatinga', 'Peixoto de Azevedo', 'Jaciara',
        ],
        'MS' => [
            'Campo Grande', 'Dourados', 'Três Lagoas', 'Corumbá', 'Ponta Porã',
            'Naviraí', 'Nova Andradina', 'Aquidauana', 'Sidrolândia', 'Paranaíba',
            'Maracaju', 'Amambai', 'Coxim', 'Rio Brilhante', 'Caarapó',
            'São Gabriel do Oeste', 'Chapadão do Sul', 'Bataguassu', 'Miranda', 'Jardim',
        ],
        'MG' => [
            'Belo Horizonte', 'Uberlândia', 'Contagem', 'Juiz de Fora', 'Betim',
            'Montes Claros', 'Ribeirão das Neves', 'Uberaba', 'Governador Valadares', 'Ipatinga',
            'Sete Lagoas', 'Divinópolis', 'Santa Luzia', 'Ibirité', 'Poços de Caldas',
            'Patos de Minas', 'Pouso Alegre', 'Teófilo Otoni', 'Barbacena', 'Varginha',
            'Conselheiro Lafaiete', 'Sabará', 'Itabira', 'Araguari', 'Passos',
            'Ubá', 'Nova Serrana', 'Ituiutaba', 'Muriaé', 'Pará de Minas',
            'Coronel Fabriciano', 'Lavras', 'Viçosa', 'Timóteo', 'São João del-Rei',
        ],
        'PA' => [
            'Belém', 'Ananindeua', 'Santarém', 'Marabá', 'Parauapebas',
            'Castanhal', 'Abaetetuba', 'Cametá', 'Bragança', 'Marituba',
            'Barcarena', 'São Félix do Xingu', 'Altamira', 'Redenção', 'Tucuruí',
            'Itaituba', 'Paragominas', 'Tailândia', 'Moju', 'Capanema',
        ],
        'PB' => [
            'João Pessoa', 'Campina Grande', 'Santa Rita', 'Patos', 'Bayeux',
            'Sousa', 'Cabedelo', 'Cajazeiras', 'Guarabira', 'São Bento',
            'Monteiro', 'Esperança', 'Pombal', 'Mamanguape', 'Queimadas',
            'Alagoa Grande', 'Pedras de Fogo', 'Itabaiana', 'Catolé do Rocha', 'Lagoa Seca',
        ],
        'PR' => [
            'Curitiba', 'Londrina', 'Maringá', 'Ponta Grossa', 'Cascavel',
            'São José dos Pinhais', 'Foz do Iguaçu', 'Colombo', 'Guarapuava', 'Paranaguá',
            'Toledo', 'Araucária', 'Apucarana', 'Pinhais', 'Campo Largo',
            'Almirante Tamandaré', 'Umuarama', 'Cambé', 'Sarandi', 'Paranavaí',
        ],
        'PE' => [
            'Recife', 'Jaboatão dos Guararapes', 'Olinda', 'Caruaru', 'Petrolina',
            'Paulista', 'Cabo de Santo Agostinho', 'Camaragibe', 'Garanhuns', 'Vitória de Santo Antão',
            'Igarassu', 'São Lourenço da Mata', 'Santa Cruz do Capibaribe', 'Abreu e Lima', 'Serra Talhada',
            'Ipojuca', 'Araripina', 'Gravatá', 'Belo Jardim', 'Goiana',
        ],
        'PI' => [
            'Teresina', 'Parnaíba', 'Picos', 'Floriano', 'Piripiri',
            'Campo Maior', 'Barras', 'União', 'Altos', 'José de Freitas',
            'Esperantina', 'Oeiras', 'São Raimundo Nonato', 'Pedro II', 'Luís Correia',
            'Miguel Alves', 'Cocal', 'Batalha', 'Corrente', 'Bom Jesus',
        ],
        'RJ' => [
            'Rio de Janeiro', 'São Gonçalo', 'Duque de Caxias', 'Nova Iguaçu', 'Niterói',
            'Belford Roxo', 'Campos dos Goytacazes', 'São João de Meriti', 'Petrópolis', 'Volta Redonda',
            'Magé', 'Itaboraí', 'Mesquita', 'Cabo Frio', 'Nilópolis',
            'Macaé', 'Teresópolis', 'Angra dos Reis', 'Barra Mansa', 'Resende',
            'Queimados', 'Maricá', 'Nova Friburgo', 'Rio das Ostras', 'Itaguaí',
            'Japeri', 'Guapimirim', 'São Pedro da Aldeia', 'Três Rios', 'Araruama',
            'Seropédica', 'Saquarema', 'Paracambi', 'Barra do Piraí', 'Casimiro de Abreu',
            'Mangaratiba', 'Sapucaia', 'Iguaba Grande', 'Quissamã', 'Valença',
        ],
        'RN' => [
            'Natal', 'Mossoró', 'Parnamirim', 'São Gonçalo do Amarante', 'Macaíba',
            'Ceará-Mirim', 'Caicó', 'Açu', 'Currais Novos', 'São José de Mipibu',
            'Santa Cruz', 'Nova Cruz', 'Apodi', 'João Câmara', 'Canguaretama',
            'Touros', 'Pau dos Ferros', 'Extremoz', 'Areia Branca', 'Baraúna',
        ],
        'RS' => [
            'Porto Alegre', 'Caxias do Sul', 'Pelotas', 'Santa Maria', 'Gravataí',
            'Viamão', 'Novo Hamburgo', 'São Leopoldo', 'Rio Grande', 'Bagé',
            'Cachoeirinha', 'Passo Fundo', 'Santa Cruz do Sul', 'Uruguaiana', 'Sapiranga',
            'Lajeado', 'Erechim', 'Esteio', 'Canela', 'Carazinho',
        ],
        'RO' => [
            'Porto Velho', 'Ji-Paraná', 'Ariquemes', 'Cacoal', 'Vilhena',
            'Rolim de Moura', 'Pimenta Bueno', 'Buritis', 'Guajará-Mirim', 'Jaru',
            'Espigão do Oeste', 'São Francisco do Sul', 'Ouro Preto do Oeste', 'Alta Floresta d’Oeste', 'Monte Negro',
            'Castanheiras', 'Cujubim', 'Mirante da Serra', 'Campo Novo de Rondônia', 'Alto Paraíso',
        ],
        'RR' => [
            'Boa Vista', 'Rorainópolis', 'Caracaraí', 'Cantá', 'Mucajaí',
            'Normandia', 'São João da Baliza', 'São Luiz', 'Pacaraima', 'Amajari',
            'Iracema', 'Uiramutã', 'Bom Jesus', 'Boa Vista do Ramos', 'Barcelos',
            'Itaúba', 'Santa Maria do Boiaçu', 'Raposa', 'Demerval', 'Caroebe',
        ],
        'SC' => [
            'Florianópolis', 'Joinville', 'Blumenau', 'São José', 'Criciúma',
            'Lages', 'Chapecó', 'Itajaí', 'Jaraguá do Sul', 'Balneário Camboriú',
            'Palhoça', 'Indaial', 'Concórdia', 'Rio do Sul', 'Araranguá',
            'Caçador', 'Tubarão', 'Brusque', 'Curitibanos', 'Sao Bento do Sul',
        ],
        'SP' => [
            'São Paulo', 'Guarulhos', 'Campinas', 'São Bernardo do Campo', 'Santo André',
            'Osasco', 'São José dos Campos', 'Ribeirão Preto', 'Sorocaba', 'Santos',
            'Mauá', 'São José do Rio Preto', 'Mogi das Cruzes', 'Diadema', 'Jundiaí',
            'Piracicaba', 'Carapicuíba', 'Bauru', 'Itaquaquecetuba', 'Limeira',
            'Barueri', 'Pirassununga', 'Franca', 'Cotia', 'Taubaté',
            'São Vicente', 'Atibaia', 'Araraquara', 'Avaré', 'Botucatu',
            'São Caetano do Sul', 'Indaiatuba', 'Bragança Paulista', 'Rio Claro', 'Itu',
            'Jundiaí', 'Tatuí', 'Marília', 'Itapevi', 'Araçatuba',
            'Arujá', 'São Carlos', 'Guarujá', 'Jaú', 'Assis',
            'Lins', 'Ourinhos', 'Itatiba', 'Taquaritinga', 'São Roque',
            'Monte Mor', 'Mogi Guaçu', 'Votorantim', 'Tremembé', 'Vila Velha',
            'São João da Boa Vista', 'Valinhos', 'Americana', 'Tatuí', 'Pindamonhangaba',
            'Campos do Jordão', 'Lins', 'Marília', 'Limeira', 'Indaiatuba',
            'Jundiaí', 'Presidente Prudente', 'Ribeirão Pires', 'Piraju', 'São Sebastião',
            'Araras', 'Sertãozinho', 'Santos', 'São Lourenço da Serra', 'Itapevi',
            'Birigui', 'Bebedouro', 'Franca', 'Bauru', 'Araçatuba',
            'Mogi das Cruzes', 'São Vicente', 'Itu', 'Barueri', 'Carapicuíba',
            'Diadema', 'Piracicaba', 'Sorocaba', 'Osasco', 'São Paulo',
            'São Caetano do Sul', 'Guarulhos', 'Campinas', 'São Bernardo do Campo', 'Santo André',
        ],
        'SE' => [
            'Aracaju', 'Nossa Senhora do Socorro', 'Lagarto', 'Itabaiana', 'São Cristóvão',
            'Estância', 'Tobias Barreto', 'Simão Dias', 'Barra dos Coqueiros', 'Campo do Brito',
            'Poço Verde', 'Salgado', 'Arauá', 'Malhada dos Bois', 'Indiaroba',
            'Japaratuba', 'Riachuelo', 'Boquim', 'Santa Luzia do Itanhy', 'Pinhão',
        ],
        'TO' => [
            'Palmas', 'Araguaína', 'Gurupi', 'Porto Nacional', 'Paraíso do Tocantins',
            'Miracema do Tocantins', 'Augustinópolis', 'Tocantinópolis', 'Dianópolis', 'São Sebastião do Tocantins',
            'Colinas do Tocantins', 'Axixá do Tocantins', 'Monte do Carmo', 'Formoso do Araguaia', 'Chapada da Natividade',
            'Nova Rosalândia', 'Taguatinga', 'Peixe', 'Lajeado', 'Silvanópolis',
        ],
    ];
    

    public static function getCidades($estado)
    {
        return self::$cidades[$estado] ?? [];
    }

    public static function getEstadoNome($uf)
    {
        return self::$estados[$uf] ?? $uf;
    }
} 