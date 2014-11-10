<?php
class FileInsert {

    private $arrayDados = array();

    public function setCandidatos($file) {

        $mongo = new Mongo();
        $db = $mongo->selectDB('trabalhoatp')->candidato;
                      
        if (!file_exists($file))
            die('FileInsert not loading...');

        $ler = fopen($file, 'r');
        $i = 0;
        while (($data = fgetcsv($ler, 10000, ';')) !== FALSE) {

            unset($data[29], $data[30],$data[6],$data[1],$data[11]);
            
            $insert = array(
                'DATA_GERACAO'      => self::getCharset($data[0]),
                'ANO_ELEICAO'       => self::getCharset($data[2]),
                'NUM_TURNO'         => (int) $data[3],
                'DESCRICAO_ELEICAO' => self::getCharset($data[4]),
                'SIGLA_UF'          => self::getCharset($data[5]),
                'DESCRICAO_UE'      => self::getCharset($data[7]),
                'CODIGO_CARGO'      => (int) $data[8],
                'DESCRICAO_CARGO'   => self::getCharset($data[9]),
                'NOME_CANDIDATO'    => self::getCharset($data[10]),
                'NUMERO_CANDIDATO'  => (int) $data[12],
                'NOME_URNA_CANDIDATO' => self::getCharset($data[13]),
                'COD_SITUACAO_CANDIDATURA' => (int) $data[14],
                'DES_SITUACAO_CANDIDATURA' => self::getCharset($data[15]),
                'NUMERO_PARTIDO'    => (int)$data[16],
                'SIGLA_PARTIDO'     => self::getCharset($data[17]),
                'NOME_PARTIDO'      => self::getCharset($data[18]),
                'CODIGO_LEGENDA'    => (int) $data[19],
                'SIGLA_LEGENDA'     => self::getCharset($data[20]),
                'COMPOSICAO_LEGENDA'=> self::getCharset($data[21]),
                'NOME_LEGENDA'      => self::getCharset( $data[22]),
                'CODIGO_OCUPACAO'   => (int) $data[23],
                'DESCRICAO_OCUPACAO'=> self::getCharset($data[24]),
                'DATA_NASCIMENTO'   => self::getCharset($data[25]),
                'NUM_TITULO_ELEITORAL_CANDIDATO'=> self::getCharset($data[26]),
                'IDADE_DATA_ELEICAO' => (int) $data[27],
                'CODIGO_SEXO'        => (int) $data[28],
                'DESCRICAO_GRAU_INSTRUCAO'=> self::getCharset($data[31]),
                'CODIGO_ESTADO_CIVIL'     => (int) $data[32],
                'DESCRICAO_ESTADO_CIVIL'  => self::getCharset($data[33]),
                'CODIGO_NACIONALIDADE'    => (int) $data[34],
                'DESCRICAO_NACIONALIDADE' => self::getCharset($data[35]),
                'SIGLA_UF_NASCIMENTO'     => self::getCharset($data[38]),
                'CODIGO_MUNICIPIO_NASCIMENTO' => (int) $data[39],
                'DESC_SIT_TOT_TURNO'          => self::getCharset($data[40]),
                );
             
               $res = $db->insert($insert);
               if($res)
               ++$i;            
        }  
        
         echo $i;
    }

    public static function getCharset($string) {
        return utf8_encode($string);
    }
    
}
$obj = new FileInsert();
$obj->setCandidatos('/web/trabalhoatp/tmp/consulta_cand_2014_TO.txt');