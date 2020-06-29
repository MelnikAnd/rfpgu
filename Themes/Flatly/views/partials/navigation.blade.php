<div class="dark-line-header"></div>
<div class="container-header">
    <div class="container">
        <div class="header-main"  style="@auth margin-top: 30px @endauth">
            <div class="header-columns">
                <div class="header-column">
                    <a href="/"><img src="/assets/media/service/gerb-logo.png" height="85px"></a>
                </div>
                <div class="header-column">
                    <p style="font-size: 11pt">Приднестровский государственный университет им. Т.Г.Шевченко<br>Филиал г. Рыбница</p>
                </div>
                <div class="header-column">
                    <img src="/assets/media/service/logo.png" height="85px">
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-default">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            @menu('mainMenu')
        </div>
    </div>
</nav>
@guest
    <script type="text/javascript">
        window.onscroll = function showHeader() {
            var header = document.querySelector('.navbar-default');
            if(window.pageYOffset > 50){
                header.classList.add('navbar-fixed-top');
            } else{
                header.classList.remove('navbar-fixed-top');
            }
        }
    </script>
@endguest