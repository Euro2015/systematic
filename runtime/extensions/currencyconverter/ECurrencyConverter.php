<?php
class ECurrencyConverter extends CApplicationComponent{
    public $xml_file = "www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
    public $exchange_rates = array();
    public $mysql_table = 'drg_currency_forex';

    public function currencyConverter(){

        $this->checkLastUpdated();
        $exchange_rates = Yii::app()->db->createCommand()
                        ->select("*")
                        ->from($this->mysql_table)
                        ->queryAll();

        foreach($exchange_rates as $row){

            $this->exchange_rates[$row['currency']] = $row['rate'];
        }
    }

   public function convert($amount=1,$from="GBP",$to="USD",$decimals=2) {
        return(number_format(($amount/$this->exchange_rates[$from])*$this->exchange_rates[$to],$decimals));
    }

    public function checkLastUpdated(){
        $command1 = Yii::app()->db->createCommand("SHOW TABLE STATUS LIKE '".$this->mysql_table."'");
        $result = $command1->query();

        if(count($result) == 0){
            $this->createTable();
        }
        else{
            if(time() > (strtotime($resul["Update_time"])+(12*60*60)) ) {
                $this->downloadExchangeRates();
            }
        }
    }

    /* Download xml file, extract exchange rates and store values in database */
    public function downloadExchangeRates() {
        $currency_domain = substr($this->xml_file,0,strpos($this->xml_file,"/"));
        $currency_file = substr($this->xml_file,strpos($this->xml_file,"/"));
        $errno = 0;
        $errstr = true;
        $fp = @fsockopen($currency_domain, 80, $errno, $errstr, 10);
        $buffer ='';
        if($fp) {
            $out = "GET ".$currency_file." HTTP/1.1\r\n"; $out .= "Host: ".$currency_domain."\r\n";
            $out .= "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8) Gecko/20051111 Firefox/1.5\r\n";
            $out .= "Connection: Close\r\n\r\n";
            fwrite($fp, $out);
            while (!feof($fp)) {
                $buffer .= fgets($fp, 128);
            } fclose($fp);

            $pattern = "{<Cube\s*currency='(\w*)'\s*rate='([\d\.]*)'/>}is"; preg_match_all($pattern,$buffer,$xml_rates);
            array_shift($xml_rates);
            for($i=0;$i<count($xml_rates[0]);$i++) {
                $exchange_rate[$xml_rates[0][$i]] = $xml_rates[1][$i];
            }


            foreach($exchange_rate as $currency=>$rate) {
                if((is_numeric($rate)) && ($rate != 0)) {
                    $sql =Yii::app()->db->createCommand("SELECT * FROM ".$this->mysql_table." WHERE currency='".$currency."'");
                    $rs =$sql->query();
                    if(count($rs) > 0) {
                        $sql_statement = Yii::app()->db->createCommand("UPDATE ".$this->mysql_table." SET rate=".$rate." WHERE currency='".$currency."'");
                    } else {
                        $sql_statement = Yii::app()->db->createCommand("INSERT INTO ".$this->mysql_table." VALUES('".$currency."',".$rate.")");
                    }
                    $result = $sql_statement->query();
                }
            }
        }
    }
    /* Create the currency exchange table */
    public function createTable() {
        $createSql = "CREATE TABLE ".$this->mysql_table." ( currency char(3) NOT NULL default '', rate float NOT NULL default '0', PRIMARY KEY(currency) ) ENGINE=MyISAM";
        $create_command = Yii::app()->db->createCommand($createSql);
        $create_command->query();
        $insertSql = "INSERT INTO ".$this->mysql_table." VALUES('EUR',1)";
        $insert_command = Yii::app()->db->createCommand($insertSql);
        $insert_command->query();
        $this->downloadExchangeRates();
    }

}
?>