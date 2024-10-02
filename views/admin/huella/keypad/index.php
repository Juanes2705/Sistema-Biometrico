<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<body>
<div class="wrapper">
  <!-- Área del teléfono -->
  <div class="phone">
    <span class="title">Phone Keyboard</span>
    <!-- Contenedor del teléfono -->
    <div class="phone-container">
      <input type="text" maxlength="11" class="number-input" id="numberInput" value="" placeholder="Phone Number"/>
      <!-- Teclado -->
      <div class="keyboard">
        <div class="number">
          <span data-number="1"><i>1</i></span>
          <span data-number="2"><i>2</i></span>
          <span data-number="3"><i>3</i></span>
          <span data-number="4"><i>4</i></span>
          <span data-number="5"><i>5</i></span>
          <span data-number="6"><i>6</i></span>
          <span data-number="7"><i>7</i></span>
          <span data-number="8"><i>8</i></span>
          <span data-number="9"><i>9</i></span>
        </div>
        <div class="number aling-right">
          <span class="call-button"><i><img src="https://image.flaticon.com/icons/svg/40/40316.svg" alt="" /></i></span>
          <span data-number="0"><i>0</i></span>
          <span><i class="delete"><img src="https://image.flaticon.com/icons/svg/61/61167.svg" width="30" height="30" alt="Delete" title="Delete"></i></span>
        </div>
      </div>
    </div>
    <button id="verifyButton">Verificar</button>
  </div>
  <div id="resultMessage"></div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>




