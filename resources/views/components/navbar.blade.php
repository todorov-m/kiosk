<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <div class="container">
         <div class="collapse navbar-collapse" id="navbarsExample07">
             <ul class="navbar-nav mr-auto">
                 <li class="nav-item active">
                     <a class="nav-link" href="/items">Артикули <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Link</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                     <div class="dropdown-menu" aria-labelledby="dropdown07">
                         <a class="dropdown-item" href="#">Action</a>
                         <a class="dropdown-item" href="#">Another action</a>
                         <a class="dropdown-item" href="#">Something else here</a>
                     </div>
                 </li>
             </ul>
             @auth
<ul class="navbar-nav mr-5">
    <li class="nav-item text-white">
    {{auth()->user()->username}}
    </li>
</ul>

                 <ul class="navbar-nav mr-10">

                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Админ</a>
                         <div class="dropdown-menu" aria-labelledby="dropdown08">
                             <a class="dropdown-item" href="/users">Потребители</a>
                             <a class="dropdown-item" href="/createuser">Нов потребител</a>
                             <hr/>
                             <a class="dropdown-item" href="/logout"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                     Изход
                                 </a>

                                 <form id="logout-form" action="/logout" method="POST"
                                       style="display: none;">
                                     @csrf
                                 </form>
                         </div>
                     </li>

                 </ul>

             @endauth
         </div>
     </div>
 </nav>