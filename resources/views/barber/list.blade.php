<h1>Listas de barberias - sitio en construccion</h1>
@<?php foreach ($barbers as $barber): ?>
  <div class="card">
    <p>Nombre de barberia: {{$barber->name}}</p>
    <p>Telefono: {{$barber->phone}}</p>
  </div>
<?php endforeach; ?>
