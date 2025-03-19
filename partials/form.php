 <h1 class="text-center">Strong password generator</h1>
 <h2 class="text-center text-white">Genera una password sicura</h2>

 <!-- Messaggio che mostro se i campi obbligatori sono vuoti -->

 <div id="alert-info" class="p-3 my-4 <?php echo empty($error) ? "d-none" : "d-block" ?>"><?php echo $error ?></div>


 <form class="p-3" action="" method="GET">

     <div class="mb-3"><strong>Tutti i campi sono obbligatori</strong></div>

     <!-- Sezione lunghezza password -->
     <div class="d-flex justify-content-between mb-3">
         <label for="passwordLength" class="w-50">Lunghezza password:</label>
         <input type="number" id="passwordLength" name="passwordLength" min="4" max="10" value="<?php echo isset($_GET['passwordLength']) ? $_GET['passwordLength'] : ''; ?>" placeholder="max 10" class="w-50">
     </div>

     <!-- Sezione ripetizioni caratteri -->
     <div class="d-flex justify-content-between mb-3">
         <label class="w-50">Consenti ripetizioni di uno o più caratteri:</label>
         <div class="d-flex flex-column w-50">
             <div><input type="radio" id="duplicates" name="duplicates" value="Yes" checked> <label for="duplicates">Sì</label></div>
             <div><input type="radio" id="noDuplicates" name="duplicates" value="No"> <label for="noDuplicates">No</label></div>
             <div class="d-flex justify-content-between my-2">
                 <div class="d-flex flex-column w-50">
                     <div>Selezionare almeno un'opzione:</div>
                     <div><input type="checkbox" id="upperCaseLetters" name="upperCaseLetters">
                         <label for="upperCaseLetters">Lettere Maiuscole</label>
                     </div>
                     <div><input type="checkbox" id="lowerCaseLetters" name="lowerCaseLetters">
                         <label for="lowerCaseLetters">Lettere Minuscole</label>
                     </div>
                     <div><input type="checkbox" id="numbers" name="numbers">
                         <label for="numbers">Numeri</label>
                     </div>
                     <div><input type="checkbox" id="symbols" name="symbols">
                         <label for="symbols">Simboli</label>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Sezione opzioni (checkbox) -->


     <!-- Sezione bottoni -->
     <div class="d-flex justify-content-start gap-3">
         <button type="submit" class="btn btn-primary">Invia</button>
         <button type="reset" class="btn btn-secondary">Annulla</button>
     </div>