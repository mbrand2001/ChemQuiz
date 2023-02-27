<?php
include("db_connect.php");
include("classes.php");

function calculateMolarMass($formula) {
   
   
   
   
    $elements = array(
        'H'  => 1.008,
        'He' => 4.003,
        'Li' => 6.941,
        'Be' => 9.012,
        'B'  => 10.81,
        'C'  => 12.01,
        'N'  => 14.01,
        'O'  => 16.00,
        'F'  => 19.00,
        'Ne' => 20.18,
        'Na' => 22.99,
        'Mg' => 24.31,
        'Al' => 26.98,
        'Si' => 28.09,
        'P'  => 30.97,
        'He' => 4.003,
        'Li' => 6.941,
        'Be' => 9.012,
        'B'  => 10.81,
        'C'  => 12.01,
        'N'  => 14.01,
        'O'  => 16.00,
        'F'  => 19.00,
        'Ne' => 20.18,
        'Na' => 22.99,
        'Mg' => 24.31,
        'Al' => 26.98,
        'Si' => 28.09,
        'P'  => 30.97,
        'S'  => 32.06,
        'Cl' => 35.45,
        'K'  => 39.10,
        'Ca' => 40.08,
        'Sc' => 44.96,
        'Ti' => 47.87,
        'V'  => 50.94,
        'Cr' => 52.00,
        'Mn' => 54.94,
        'Fe' => 55.85,
        'Ni' => 58.69,
        'Co' => 58.93,
        'Cu' => 63.55,
        'Zn' => 65.38,
        'Ga' => 69.72,
        'Ge' => 72.63,
        'As' => 74.92,
        'Se' => 78.96,
        'Br' => 79.90,
        'Kr' => 83.80,
        'Rb' => 85.47,
        'Sr' => 87.62,
        'Y'  => 88.91,
        'Zr' => 91.22,
        'Nb' => 92.91,
        'Mo' => 95.94,
        'Tc' => 98.00,
        'Ru' => 101.1,
        'Rh' => 102.9,
        'Pd' => 106.4,
        'Ag' => 107.9,
        'Cd' => 112.4,
        'In' => 114.8,
        'Sn' => 118.7,
        'Sb' => 121.8,
        'Te' => 127.6,
        'I'  => 126.9,
        'Xe' => 131.3,
        'Cs' => 132.9,
        'Ba' => 137.3,
        'La' => 138.9,
        'Ce' => 140.1,
        'Pr' => 140.9,
        'Nd' => 144.2,
        'Pm' => 145.0,
        'Sm' => 150.4,
        'Eu' => 152.0,
        'Gd' => 157.3,
        'Tb' => 158.9,
        'Dy' => 162.5,
        'Ho' => 164.9,
        'Er' => 167.3,
        'Tm' => 168.9,
        'Yb' => 173.0,
        'Lu' => 175.0,
        'Hf' => 178.5,
        'Ta' => 180.95,
        'W' => 183.84,
        'Re' => 186.21,
        'Os' => 190.23,
        'Ir' => 192.22,
        'Pt' => 195.08,
        'Au' => 196.97,
        'Hg' => 200.59,
        'Tl' => 204.38,
        'Pb' => 207.2,
        'Bi' => 208.98,
        'Po' => 209.0,
        'At' => 210.0,
        'Rn' => 222.0,
        'Fr' => 223.0,
        'Ra' => 226.03,
        'Ac' => 227.03,
        'Th' => 232.04,
        'Pa' => 231.04,
        'U' => 238.03,
        'Np' => 237.05,
        'Pu' => 244.06,
        'Am' => 243.06,
        'Cm' => 247.07,
        'Bk' => 247.07,
        'Cf' => 251.08,
        'Es' => 252.08,
        'Fm' => 257.10,
        'Md' => 258.10,
        'No' => 259.10,
        'Lr' => 262.11,
        'Rf' => 267.12,
        'Db' => 270.13,
        'Sg' => 271.13,
        'Bh' => 270.13,
        'Hs' => 277.15,
        'Mt' => 276.15,
        'Ds' => 281.16,
        'Rg' => 280.16,
        'Cn' => 285.17,
        'Nh' => 284.18,
        'Fl' => 289.19,
        'Mc' => 288.19,
        'Lv' => 293.20,
        'Ts' => 294.21,
        'Og' => 294.21,
        'S'  => 32.06,
        'Cl' => 35.45,
        'K'  => 39.10,
        'Ca' => 40.08,
        'Sc' => 44.96,
        'Ti' => 47.87,
        'V'  => 50.94,
        'Cr' => 52.00,
        'Mn' => 54.94,
        'Fe' => 55.85,
        'Ni' => 58.69,
        'Co' => 58.93,
        'Cu' => 63.55,
        'Zn' => 65.38,
        'Ga' => 69.72,
        'Ge' => 72.63,
        'As' => 74.92,
        'Se' => 78.96,
        'Br' => 79.90,
        'Kr' => 83.80,
        'Rb' => 85.47,
        'Sr' => 87.62,
        'Y'  => 88.91,
        'Zr' => 91.22,
        'Nb' => 92.91,
        'Mo' => 95.94,
        'Tc' => 98.00,
        'Ru' => 101.1,
        'Rh' => 102.9,
        'Pd' => 106.4,
        'Ag' => 107.9,
        'Cd' => 112.4,
        'In' => 114.8,
        'Sn' => 118.7,
        'Sb' => 121.8,
        'Te' => 127.6,
        'I'  => 126.9,
        'Xe' => 131.3,
        'Cs' => 132.9,
        'Ba' => 137.3,
        'La' => 138.9,
        'Ce' => 140.1,
        'Pr' => 140.9,
        'Nd' => 144.2,
        'Pm' => 145.0,
        'Sm' => 150.4,
        'Eu' => 152.0,
        'Gd' => 157.3,
        'Tb' => 158.9,
        'Dy' => 162.5,
        'Ho' => 164.9,
        'Er' => 167.3,
        'Tm' => 168.9,
        'Yb' => 173.0,
        'Lu' => 175.0,
        'Hf' => 178.5,
        'Ta' => 180.95,
        'W' => 183.84,
        'Re' => 186.21,
        'Os' => 190.23,
        'Ir' => 192.22,
        'Pt' => 195.08,
        'Au' => 196.97,
        'Hg' => 200.59,
        'Tl' => 204.38,
        'Pb' => 207.2,
        'Bi' => 208.98,
        'Po' => 209.0,
        'At' => 210.0,
        'Rn' => 222.0,
        'Fr' => 223.0,
        'Ra' => 226.03,
        'Ac' => 227.03,
        'Th' => 232.04,
        'Pa' => 231.04,
        'U' => 238.03,
        'Np' => 237.05,
        'Pu' => 244.06,
        'Am' => 243.06,
        'Cm' => 247.07,
        'Bk' => 247.07,
        'Cf' => 251.08,
        'Es' => 252.08,
        'Fm' => 257.10,
        'Md' => 258.10,
        'No' => 259.10,
        'Lr' => 262.11,
        'Rf' => 267.12,
        'Db' => 270.13,
        'Sg' => 271.13,
        'Bh' => 270.13,
        'Hs' => 277.15,
        'Mt' => 276.15,
        'Ds' => 281.16,
        'Rg' => 280.16,
        'Cn' => 285.17,
        'Nh' => 284.18,
        'Fl' => 289.19,
        'Mc' => 288.19,
        'Lv' => 293.20,
        'Ts' => 294.21,
        'Og' => 294.21
);







  $molarMass = 0;
  $currentElement = '';
  $currentCount = '';
  for ($i = 0; $i < strlen($formula); $i++) {
    $char = $formula[$i];
    if (ctype_upper($char)) {
      // If uppercase letter is encountered, start a new element
      
      $molarMass += (float)$elements[$currentElement] * (int)$currentCount;
      $currentElement = $char;
      $currentCount = '';
    } else if (ctype_lower($char)) {
      // If lowercase letter is encountered, append to current element
      $currentElement .= $char;
    } else if (ctype_digit($char)) {
      // If digit is encountered, append to current count
      $currentCount .= $char;
      
     
    }
    if((ctype_upper($formula[$i +1]) || !isset($formula[$i +1]))&& ctype_upper($char)){ 
        $currentCount .= '1';

    }
    
  }
  // Add the last element
      echo $currentElement;
      echo $currentCount."<br>";
  $molarMass += (float)$elements[$currentElement] * (int)$currentCount;

  return $molarMass;
}


$formula = "C21H23NO5";
$molarMass = calculateMolarMass($formula);

echo "The molar mass of $formula is $molarMass g/mol.";

?>
