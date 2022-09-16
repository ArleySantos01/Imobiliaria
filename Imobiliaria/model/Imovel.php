<?php 
    # Tarefa imóvel: registre uma imobiliária
    require_once 'Banco.php';
    require_once 'Conexao.php';

    class Imovel extends Banco
    {
        private $id;
        private $foto;
        private $tipo;
        private $valor;
        private $descricao;
        private $fotoTipo;
        
        public function getIdImovel()
        {
            return $this->id;
        }

        public function setIdImovel($id)
        {
            $this->id = $id;
        }

        public function getFoto()
        {
            return $this->foto;
        }

        public function setFoto($foto)
        {
            $this->foto = $foto;
        }
        
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

        public function getFotoTipo()
        {
            return $this->fotoTipo;
        }

        public function setFotoTipo($fotoTipo)
        {
            $this->fotoTipo = $fotoTipo;
        }

        public function save()
        {
            $result = false;

            # Cria um objeto do tipo conexao
            $conexao = new Conexao();

            # Cria um query de inserção passando os atributos que serão armazenados            
            # $query = "insert into imovel (id, descricao, tipo, valor) values (null, :descricao, :tipo, :valor)";

            if ($conn = $conexao->getConnection())
            {
                if ($this->id > 0)
                {
                    $query = "UPDATE imovel SET descricao = :descricao, foto = :foto, valor = :valor, tipo = :tipo, fotoTipo = :fotoTipo WHERE id = :id";
                    $stmt = $conn->prepare($query);
                    if ($stmt->execute(array(':descricao' => $this->descricao,
                                            ':foto' => $this->foto, 
                                            ':valor' => $this->valor, 
                                            ':tipo' => $this->tipo,
                                            ':fotoTipo' => $this->fotoTipo,
                                            ':id' => $this->id))) 
                    {
                        $result = $stmt->rowCount();
                    }
                }
            

                else
                {
                    $query = "insert into imovel (id, descricao, tipo, valor, foto, fotoTipo) values (null, :descricao, :tipo, :valor, :foto, :fotoTipo)";
                    $stmt = $conn->prepare($query);
                    if ($stmt->execute(array(':descricao' => $this->descricao, 
                                            ':foto' => $this->foto, 
                                            ':valor' => $this->valor,
                                            ':tipo' => $this->tipo,
                                            ':fotoTipo' => $this->fotoTipo)))
                    {
                        $result = $stmt->rowCount();
                    }                              
                }
            }

            # Cria a conexão com o banco de dados
            /*
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
            */
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
            $query = "SELECT * FROM imovel";        # Cria a query de seleção
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