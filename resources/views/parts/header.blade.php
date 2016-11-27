
<nav class="navbar navbar-default" >
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                {{--<span class="logoLeft">PROJECT</span><span class="logoMiddle">WORLD</span><span class="logoRight">IMPACT</span>--}}
                <img src="/images/header_logo.png"  height="30" class="d-inline-block align-top" alt="" />
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">

                @if(session('loggedUser') != "")
                    <li>
                        <a href="{{ route("admin") }}" class="menu_link">
                           <span class="menu_link">{{ session('loggedUser') }}, WELCOME!</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route("signOut") }}" class="menu_link">
                            <span class="menu_link">LOG OUT</span>
                        </a>
                    </li>
                @else
                    <li class="dropdown" id="menu1">

                        <a class="menu_link dropdown-toggle " data-toggle="dropdown" href="#menu1">
                            <span class="menu_link">LOG IN</span>
                        </a>
                        <div class="dropdown-menu">
                            <form style="margin: 0px;padding:10px;" accept-charset="UTF-8" action="{{ route("signIn") }}" method="post">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                <fieldset class='textbox' style="padding:10px">

                                    <input id="email"    name="email"    class="default_input " type="text"     placeholder="Email"      size="30" />
                                    <input id="password" name="password" class="default_input " type="password" placeholder="Passsword"  size="30" />
                                    <div align="center">
                                      <input class="green_button" name="commit" type="submit" value="Log In" />
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </li>
                @endif





            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>