<?php
    # Tarefa imóvel: crie uma galeria
    #TO-DO: Criar uma base de dados Galeria,
    #       Criar uma tela para a galeria,
    #       Criar uma entrada para o index.php

    require_once 'Banco.php';
    require_once 'Conexao.php';

    class Galeria extends Banco 
    {
        private $id; #
        private $foto; #
        private $tipo; #
        # private $valor;
        private $descricao; #
        private $fotoTipo; #

        public function getIdGaleria()
        {
            return $this->id;
        }

        public function setIdGaleria($idGaleria)
        {
            $this->id = $idGaleria;
        }

        public function getFoto()
        {
            return $this->foto;
        }

        public function setFoto($fotoGaleria)
        {
            $this->foto = $fotoGaleria;
        }

        public function getTipo()
        {
            if ($this->tipo == 'A')
            {
                $res = "Apartamento";
            }
            else if ($this->tipo == 'B')
            {
                $res = "Kitnet";
            }
            else
            {
                $res = "Flat";
            }

            return $res;
        }

        public function setTipo($tipoGaleria)
        {
            $this->tipo = $tipoGaleria;
        }

        public function getDescricao()
        {
            return $this->descricao;
        }

        public function setDescricao($descricaoGaleria)
        {
            $this->descricao = $descricaoGaleria;
        }

        public function getFotoTipo()
        {
            return $this->fotoTipo;
        }

        public function setFotoTipo($galeriaFotoTipo)
        {
            $this->fotoTipo = $galeriaFotoTipo;
        }

        public function save()
        {
            $result = false;
            $conexao = new Conexao();

            if ($conn = $conexao->getConnection())
            {
                if ($this->id > 0)
                {
                    # Possível erro aqui
                    $query = "UPDATE galeria SET descricao = :descricao, foto = :foto, tipo = :tipo, fotoTipo = :fotoTipo WHERE id = :id";
                    $stmt = $conn->prepare($query);
                    if ($stmt->execute(array(':descricao' => $this->descricao,
                                             ':foto' => $this->foto,
                                             ':tipo' => $this->tipo,
                                             ':fotoTipo' => $this->fotoTipo,
                                             ':id' => $this->id)))
                    {
                        $result = $stmt->rowCount();
                    }
                }

                # Possível erro aqui
                else
                {
                    $query = "INSERT INTO galeria (descricao, foto, tipo, fotoTipo, id) VALUES (:descricao, :foto, :tipo, :fotoTipo, null)";
                    $stmt = $conn->prepare($query);
                    if ($stmt->execute(array(':descricao' => $this->descricao,
                                             ':foto' => $this->foto,
                                             ':tipo' => $this->tipo,
                                             ':fotoTipo' => $this->fotoTipo)))
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
            $conn = $conexao->getConnection();
            $query = "delete from galeria where id = :id";  # Remoção de uma galeria
            $stmt = $conn->prepare($query);

            if ($stmt->execute(array(':id' => $id)))
            {
                if ($stmt->rowCount() > 0)
                {
                    $result = $stmt->fetchObject(Galeria::class);   # CLASSE INEXISTENTE, CRIAR                    
                }

                else
                {
                    $result = false;
                }
            }

            return $result;
        }

        public function find($idGaleria)
        {
            $conexao = new Conexao();
            $conn = $conexao->getConnection();
            $query = "SELECT * FROM galeria WHERE id = :id";
            $stmt = $conn->prepare($query);

            if ($stmt->execute(array(':id' => $idGaleria)))
            {
                if ($stmt->rowCount() > 0)
                {
                    $result = $stmt->fetchObject(Galeria::class);
                }
            }

            else
            {
                $result = false;
            }

            return $result;
        }

        public function count()
        {
            
        }

        public function listAll()
        {
            $result = false;
            $conexao = new Conexao();
            $conn = $conexao->getConnection();
            $query = "SELECT * FROM galeria";
            $stmt = $conn->prepare($query);
            $result = array();

            if ($stmt->execute())
            {
                while ($rs = $stmt->fetchObject(Galeria::class))
                {
                    $result[] = $rs;
                }
            }

            return $result;
        }
    }
?>