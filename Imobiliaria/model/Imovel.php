<?php 
    # Tarefa imóvel: registre uma imobiliária
    require_once 'Banco.php';
    require_once 'Conexao.php';

    class Imovel extends Banco
    {
        private $id;
        private $tipo;
        private $valor;
        private $descricao;

        
        public function getIdImovel()
        {
            return $this->id;
        }

        public function setIdImovel($id)
        {
            $this->id = $id;
        }

        # modifique
        public function getTipo()
        {
            if($this->tipo == 'A')
            {
                $res = "Apartamento";
            }
            else if($this->tipo == 'B')
            {
                $res = "Kitnet";
            }
            else
            {
                $res = "Flat";
            }

            return $res;
        }

        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }

        public function getPreco()
        {
            return $this->valor;
        }

        public function setPreco($preco)
        {
            $this->valor = $preco;
        }

        public function getDescricao()
        {
            return $this->descricao;
        }

        public function setDescricao($descricao)
        {
            $this->descricao = $descricao;
        }

        public function save()
        {
            # Cria um objeto do tipo conexao
            $conexao = new Conexao();

            # Cria um query de inserção passando os atributos que serão armazenados
            $query = "insert into imovel (id, descricao, tipo, valor) values (null, :descricao, :tipo, :valor)";

            # Cria a conexão com o banco de dados
            if ($conn = $conexao->getConnection())
            {
                # Prepara a query para execução
                $stmt = $conn->prepare($query);

                # Executa a query
                if ($stmt->execute(array(':descricao'=>$this->descricao, 
                                         ':valor'=>$this->valor,
                                         ':tipo'=>$this->tipo)))
                {
                    $result = $stmt->rowCount();
                }
            }
            return $result;
        }

        public function remove($id)
        {
            $result = false;
            $conexao = new Conexao();
            $conn = $conexao->getConnection();      # Cria a conexão com o banco de dados
            $query = "delete from imovel where id = :id";      # Cria a query de remoção
            $stmt = $conn->prepare($query);

            if ($stmt->execute(array(':id' => $id)))
            {
                $result = true;
            }
            return $result;
        }
        public function find($id)
        {
            $conexao = new Conexao();
            $conn = $conexao->getConnection();
            $query = "select * from imovel where id = :id";    # Cria um query de seleção
            $stmt = $conn->prepare($query);                     # Prepara a query para a execução

            # Execute a query
            if ($stmt->execute(array(':id' => $id)))
            {
                # Verifica se houve algum registro encontrado
                if ($stmt->rowCount() > 0)
                {
                    # O resultado da busca irá retornado como um objeto da classe
                    $result = $stmt->fetchObject(Usuario::class);
                }
                else
                {
                    $result = false;
                }
            }
            return $result;
        }

        public function count()
        {
            
        }

        public function listAll()
        {
            $result = false;
            $conexao = new Conexao();               # Objeto do tipo conexão
            $conn = $conexao->getConnection();      # Cria a conexão com o banco de dados
            $query = "SELECT * FROM imovel";   # Cria a query de seleção
            $stmt = $conn->prepare($query);         # Prepara a query para execução
            $result = array();                      # Cria um array para receber o resultado da seleção

            # Executa a query
            if ($stmt->execute())
            {
                # O resultado da busca será retornado como um objeto da classe
                while ($rs = $stmt->fetchObject(Imovel::class))
                {
                    $result[] = $rs;    # Armazena esse objeto em uma posição do vetor
                }
            }

            return $result;
        }
    }
?>