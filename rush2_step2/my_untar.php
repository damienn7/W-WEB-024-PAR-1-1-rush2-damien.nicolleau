<?php

// FICHIER DE L'étape 1 du rush
//var_dump($argv);

if(isset($argv))
{
    //var_dump($argv);

    //+ condition pour vérifier que les paramètres sont des fichiers
    foreach($argv as $key => $arg)
    {
        $extension=substr($arg,strlen($arg)-6,strlen($arg));

        if($extension==".mytar"&&$key>0)
        {
            if(file_exists("./$arg"))
            {
                $finput=fopen($arg,"rb");
                $binary = fread($finput, filesize($arg));
                fclose($finput);
                //base64_decode($binary);
                $return=Decompression($binary);

                $handle=fopen("output.txt","wb");
                $write=fwrite($handle,$return);
                fclose($handle);

            }

        }
        else
        {
            unset($argv[$key]);
        }

    }

}
else
{
    echo "Veuillez saisir des noms de fichiers valides!";
    return;
}


function Decompression($binary) {
	// convert binary string to codes
	$dictionary_count = 256;
	$bits = 8; // ceil(log($dictionary_count, 2))
	$codes = array();
	$rest = 0;
	$rest_length = 0;
	for ($i=0; $i < strlen($binary); $i++) {
		$rest = ($rest << 8) + ord($binary[$i]);
		$rest_length += 8;
		if ($rest_length >= $bits) {
			$rest_length -= $bits;
			$codes[] = $rest >> $rest_length;
			$rest &= (1 << $rest_length) - 1;
			$dictionary_count++;
			if ($dictionary_count >> $bits) {
				$bits++;
			}
		}
	}
	
	// decompression
	$dictionary = range("\0", "\xFF");
	$return = "";
	foreach ($codes as $i => $code) {
		$element = $dictionary[$code];
		if (!isset($element)) {
			$element = $word . $word[0];
		}
		$return .= $element;
		if ($i) {
			$dictionary[] = $word . $element[0];
		}
		$word = $element;
	}
	return $return;
}





/*

w ← ""
TANT QUE (il reste des caractères à lire dans Texte) FAIRE
c ← Lire(Texte)
p ← Concaténer(w, c)
SI Existe(p, dictionnaire) ALORS
w ← p
SINON
Ajouter(p, dictionnaire)
Écrire dictionnaire[w]
w<-c
FIN TANT QUE

*/