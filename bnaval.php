<?php

	include_once 'create_map.php';

/*
**	Remplace les "," par des espaces et colore les chiffres
*/
	function char_replace(&$buffer)
	{
		$red_number = "\033[31m" . "1" . "\033[00m";
		$green_number = "\033[32m" . "2" . "\033[00m";
		$yellow_number = "\033[33m" . "3" . "\033[00m";
		$blue_number = "\033[34m" . "4" . "\033[00m";
		$purple_number = "\033[35m" . "5" . "\033[00m";

		$buffer = str_replace(',', ' ', $buffer);
		$buffer = str_replace('3', $yellow_number, $buffer);
		$buffer = str_replace('1', $red_number, $buffer);
		$buffer = str_replace('2', $green_number, $buffer);
		$buffer = str_replace('4', $blue_number, $buffer);
		$buffer = str_replace('5', $purple_number, $buffer);
	}

/*
**	Afficher le contenu du fichier dans le terminal
*/
	function display_file_content($handle)
	{
		$i = 1;
		echo "  |A B C D E F G H I J\n";
		echo "-----------------------\n";
		while (($buffer = fgets($handle)) !== false)
		{
			char_replace($buffer);

			if (strlen($i) == 1)
			{
				echo $i . ' |' . $buffer;
			}
			elseif (strlen($i) > 1)
			{
				echo $i . '|' . $buffer;
			}

			$i++;
		}
	}


/*
**	Récupère le contenu des fichiers
*/
	function get_file($argv)
	{
		foreach ($argv as $file)
		{
			$info = new SplFileInfo($file);
			$extension = $info->getExtension();

			if (is_file($file) && $extension == 'cf')
			{
				$handle = fopen($file, "r");
				display_file_content($handle);

				if (!feof($handle))
				{
					echo "Erreur: fgets() a échoué\n";
				}

				fclose($handle);
			}
		}
	}

/*
**	Fonction finale lançant toutes les autres
*/
	function bnaval($argv)
	{
		get_file($argv);
		create_map($argv);
	}

	bnaval($argv);