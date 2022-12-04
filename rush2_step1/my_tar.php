<?php
// FICHIER DE L'étape 1 du rush

if(isset($argv))
{

    //+ condition pour vérifier que les paramètres sont des fichiers
    foreach($argv as $key => $arg)
    {
        $extension=substr($arg,strlen($arg)-4,strlen($arg));

        if($extension!=".mytar"&&$key>0)
        {
            $finput=fopen($arg,"rb");
            $string = fread($finput, filesize($arg));
            fclose($finput);

            $return=Compression($string);
            $handle=fopen("output.mytar","wb");
            $write=fwrite($handle,$return);
            fclose($handle);
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


function Compression($string)
{
// compression
$dictionary = array_flip(range("\0", "\xFF"));
$word = "";
$codes = array();
for ($i=0; $i <= strlen($string); $i++) {
    $x = substr($string, $i, 1);
    if (strlen($x) && isset($dictionary[$word . $x])) {
        $word .= $x;
    } elseif ($i) {
        $codes[] = $dictionary[$word];
        $dictionary[$word . $x] = count($dictionary);
        $word = $x;
    }
}

// convert codes to binary string
$dictionary_count = 256;
$bits = 8; // ceil(log($dictionary_count, 2))
$return = "";
$rest = 0;
$rest_length = 0;
foreach ($codes as $code) {
    $rest = ($rest << $bits) + $code;
    $rest_length += $bits;
    $dictionary_count++;
    if ($dictionary_count >> $bits) {
        $bits++;
    }
    while ($rest_length > 7) {
        $rest_length -= 8;
        $return .= chr($rest >> $rest_length);
        $rest &= (1 << $rest_length) - 1;
    }
}
return $return . ($rest_length ? chr($rest << (8 - $rest_length)) : "");
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

file_get_contents(
    string $filename,
    bool $use_include_path = false,
    ?resource $context = null,
    int $offset = 0,
    ?int $length = null
): string|false
    
*/