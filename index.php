<?php
   function computeOvertime(float $hoursWorked, float $normalHours, float $overtimeRate, float $hourlyRate): float {
       $overtimeHours = max(0, $hoursWorked - $normalHours);
       return $overtimeHours * $hourlyRate * $overtimeRate;
   }

   $error = null;
   $hoursWorked = (float) ($_GET['hours_worked'] ?? 0);
   $hourlyRate = 25.0;
   $normalHours = 40.0;
   $overtimeRate = 1.5;

   if ($hoursWorked < 0) {
       $error = "Les heures travaillées doivent être supérieures ou égales à zéro";
   }

   if ($error == null) {
       $overtimePay = computeOvertime($hoursWorked, $normalHours, $overtimeRate, $hourlyRate);
       $normalPay = min($hoursWorked, $normalHours) * $hourlyRate;
       $totalPay = $normalPay + $overtimePay;
   }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <link
   rel="stylesheet"
   href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
   />
   <title>Calcul des Heures Supplémentaires</title>
</head>
<body>
   <main class="container">
       <h1>Calcul des Heures Supplémentaires</h1>
       <form action="" method="get">
           <label for="hours_worked">Heures travaillées</label>
           <input type="number" name="hours_worked" id="hours_worked" step="0.01" required>
           <button type="submit">Calculer</button>
       </form>
       <hr>
       <?php if (isset($_GET['hours_worked'])): ?>
           <?php if ($error): ?>
               <p style="color: red;"><?= $error ?></p>
           <?php else: ?>
               <p>Salaire normal : $<?= number_format($normalPay, 2) ?></p>
               <p>Rémunération des heures supplémentaires : $<?= number_format($overtimePay, 2) ?></p>
               <p>Salaire total : $<?= number_format($totalPay, 2) ?></p>
           <?php endif; ?>
       <?php endif; ?>
   </main>
</body>
</html>