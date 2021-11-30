<div class="d-flex flex-column flex-md-row align-items-center p-1 px-md-4 mb-3 bg-white border-bottom shadow-sm">
     @if (Request::path() != 'shiftend' && auth()->user()->level > 90)
    <a type="button" class="btn btn-outline-primary mr-5" href="/shiftstart">НАЧАЛО </a>
        <a type="button" class="btn btn-outline-primary" href="/reports">СПРАВКИ</a>
    @endif
    @auth

@if(auth()->user()->level > 10)
        <ul class="navbar-nav ml-auto mr-20">

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
@else
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-uppercase" href="#" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{auth()->user()->username}}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown08">
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
@endif
    @endauth
</div>



