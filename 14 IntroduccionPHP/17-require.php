<?php include 'includes/header.php';


#require y include son casi lo mismo, solo diferencia en q uno si falla cierra la ejecucion y el otro sigue ejecutando
#include: incluye archivos, templates y si no los encuentras puede ser q sigas funcionando
#require: llama a fx,archivos, templates y si no los encuentras no sigas funcionando
#include_once,requiere_once: incluye archivos, templates solo si no han sido llamados anteriormente
require '15-funciones.php';


include 'includes/footer.php';