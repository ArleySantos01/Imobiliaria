<?php
    require_once 'Banco.php';
    require_once 'Conexao.php';

    # Subclasse da superclasse Banco, sendo assim ela realiza o import da classe Banco
    # Nos métodos abstratos da classe Banco, ele irá implementar a conexão com o banco de dados
    class Usuario extends Banco
    {
        private $id;
        private $login;
        private $senha;
        private $permissao;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function setLogin($login)
        {
            $this->login = $login;
        }

        public function getSenha()
        {
            return $this->senha;
        }

        public function setSenha($senha)
        {
            $this->senha = $senha;
        }

        # modifique/copie
        public function getPermissao()
        {
            if($this->permissao == 'A')
            {
                $res = "Administrador";
            }
            else
            {
                $res = "Comum";
            }
            return $res;
        }

        public function setPermissao($permissao)
        {
            $this->permissao = $permissao;
        }

        # Cadastro e atualização dos dados
        public function save()
        {
            $result = false;
            $conexao = new Conexao();
        
            # Cria a conexão com o banco de dados
            if ($conn = $conexao->getConnection())
            {
                if ($this->id > 0)
                {
                    # Cria query de update passando os atributos que serão atualizados
                    $query = "update usuario set login = :login, senha = :senha, permissao = :permissao where id = :id";
                    
                    # Prepara a query execução
                    $stmt = $conn->prepare($query);
                    
                    # Executa a query
                    if ($stmt->execute(array(':login' => $this->login,
                                             ':senha' => $this->senha,
                                             ':permissao' => $this->permissao,
                                             ':id' => $this->id)))
                    {
                        $result = $stmt->rowCount();
                    }
                }
                else
                {
                    # Cria query de inserção passando os atributos que serão armazenados
                    $query = "insert into usuario (id, login, senha, permissao) values (null, :login, :senha, :permissao)";
                    
                    # Prepara a query para a execução
                    $stmt = $conn->prepare($query);
                    
                    # Executa a query
                    if ($stmt->execute(array(':login'=>$this->login,
                                             ':senha'=>$this->senha,
                                             ':permissao'=>$this->permissao)))
                    {
                        $result = $stmt->rowCount();
                    }
                }
            }
            return $result;
        }

        public function remove($id)
        {
            $result = false;
            $conexao = new Conexao();
            $conn = $conexao->getConnection();      # Cria a conexão com o banco de dados
            $query = "delete from usuario where id = :id";      # Cria a query de remoção
            $stmt = $conn->prepare($query);

            if ($stmt->execute(array(':id' => $id)))
            {
                $result = true;
            }
            return $result;
        }

        # Busca os dados do usuário que deve ser alterado
        public function find($id)
        {
            $conexao = new Conexao();
            $conn = $conexao->getConnection();
            $query = "select * from usuario where id = :id";    # Cria um query de seleção
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
            $conexao = new Conexao();           # Objeto do tipo conexão
            $conn = $conexao->getConnection();  # Cria a conexão com o banco de dados
            $query = "SELECT * FROM usuario";   # Cria a query de seleção
            $stmt = $conn->prepare($query);     # Prepara a query para execução
            $result = array();                  # Cria um array para receber o resultado da seleção

            # Executa a query
            if ($stmt->execute())
            {
                # O resultado da busca será retornado como um objeto da classe 
                while ($rs = $stmt->fetchObject(Usuario::class))
                {
                    $result[] = $rs;    # Armazena esse objeto em uma posição do vetor
                }
            }

            return $result;
        }
    }
?>