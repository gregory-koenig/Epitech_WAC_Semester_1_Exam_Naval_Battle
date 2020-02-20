<?php

/*
**	Gère l'entrée standard et enregistre dans un tableau les réponses
**	de l'utilisateur
*/
	function standard_stream($argv, &$array_map)
	{
		foreach ($argv as $option)
		{
			if ($option == '-u')
			{
				$stdin = fopen('php://stdin', 'r');

				echo "Veuillez entrer les coordonnées du sous-marin (1 case) :\n";
				$submarine = fgets($stdin);
				echo "Veuillez entrer les coordonnées du destroyer (2 cases) :\n";
				$destroyer = fgets($stdin);
				echo "Veuillez entrer les coordonnées du croiseur (3 cases) :\n";
				$cruiser = fgets($stdin);
				echo "Veuillez entrer les coordonnées du bateau de combat (4 cases) :\n";
				$warship = fgets($stdin);
				echo "Veuillez entrer les coordonnées du porte-avion (5 cases) :\n";
				$aircraft_carrier = fgets($stdin);

				$array_map = ["submarine" => $submarine,
					"destroyer" => $destroyer,
					"cruiser" => $cruiser,
					"warship" => $warship,
					"aircraft_carrier" => $aircraft_carrier];
			}
		}
	}

/*
**	Prépare le contenu à écrire dans un fichier
*/
	function write_file($array_map)
	{
		$content = '';
		for ($i = 1; $i <= 10; $i++)
		{
			$content = $content . "0, 0, 0, 0, 0, 0, 0, 0, 0, 0\n";

			if ($i == 10)
			{
				$content = $content . "0, 0, 0, 0, 0, 0, 0, 0, 0, 0";
			}
		}
		return $content;
	}

/*
**	Crée un fichier
*/
	function create_file($argv, $array_map)
	{
		foreach ($argv as $option)
		{
			$option_format = strrev($option);
			$option_format = strtok($option_format, '.');
			$option_format = strrev($option_format);

			if ($option_format == 'map')
			{
				$handle = fopen($option, "w+");
				$content = write_file($array_map);
				fwrite($handle, $content);
				fclose($handle);
			}
		}
	}

/*
**	Fonction finale créant la carte dans un fichier
*/
	function create_map($argv)
	{
		$array_map = [];
		standard_stream($argv, $array_map);
		create_file($argv, $array_map);
	}