<div class="dark-line-header"></div>
<div class="container-header">
    <div class="container">
        <div class="header-main"  style="@auth margin-top: 30px @endauth">
            <div class="header-columns">
                <div class="header-column">
                    <a href="/"><img src="/assets/media/service/gerb-logo.png" height="85px"></a>
                </div>
                <div class="header-column">
                    <p>Приднестровский государственный университет им. Т.Г. Шевченко<br>Филиал г. Рыбница<br>
                    <a href="#" class="bvi-open" title="Версия сайта для слабовидящих" style="font-size:20px; padding-right: 10px" itemprop="copy"><span class="fa fa-eye"></span></a>
                    <a href="https://vk.com/pgu_rf" title="Версия сайта для слабовидящих" style="font-size:20px; padding-right: 10px"><span class="fa fa-vk"></span></a>
                    <a href="https://www.facebook.com/groups/rfpgu.pie" title="Версия сайта для слабовидящих" style="font-size:20px"><span class="fa fa-facebook"></span></a></p>
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