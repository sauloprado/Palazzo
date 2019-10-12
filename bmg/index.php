<!doctype html>
<html>
<head>
<meta charset="iso-8859-1">
<meta name="title" content="BMG CARD - Eu quero meu cartão agora!"/>
<meta name="description" content="BMG CARD">
<title>BMG CARD - Eu quero meu cart&atilde;o agora!</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-2.0.0.js"></script>
<script src="http://malsup.github.io/jquery.cycle.all.js"></script>
<script type="text/javascript" charset="utf-8">
$('.depoimentos').cycle({ 
    fx:     'fade', 
    speed:   1000, 
    timeout: 7000,  
});

</script>

</head>

<body>

<img src="img/bmg-fundo-full.jpg" id="full-screen-background-image" />
<section id="container-master">
        	
    <header id="container-header">
            	<aside id="container-header-form">
                	<aside class="eu-quero-top-right">
                    </aside>
                    <aside class="eu-quero-agora">
                    </aside>
                    <aside class="simples">
                    Simples, pr&aacute;tico e f&aacute;cil de adquirir.
                    </aside>
                	<aside class="form">
                    <div class="formulario">
                        <form action="envia.php" method="post" name="contato">
                        <div class="campo">
                        <input name="nome" type="text" required="required" placeholder="Nome">
                        </div>
                        
                        <div class="mini-campo">
                        <input name="fone" type="tel" required="required" placeholder="Fone">
                        </div>
                        
                        <div class="mini-campo2">
                        <input name="ramal" type="tel" required="required" placeholder="Ramal">
                        </div>
                        
                        <div class="email">
                        <input name="email" type="text" required="required" placeholder="Email">
                        </div>
                        
                        <div class="enviar">
                        <input type="image" src="img/botao.png" value="enviar">
                        </div>
                        
                        </form>
                      </div>
                    </aside>
                </aside>
            </header>
            <section id="container-corpo">
           	<section class="cartao"></section>
            </section>
            <section id="container-corpo2">
				<section class="vantagens"><img src="img/bmg-vantagens-depo3.fw.png" alt="" width="620" height="174" usemap="#Map"/>
                  <map name="Map">
                    <area shape="rect" coords="337,21,603,154" href="http://www.bancobmg.com.br/site/" target="_blank">
                  </map>
				</section>
                <section class="depoimentos">
			    <img src="img/depo1.jpg" width="280" height="174" alt=""/>
                <img src="img/depo2.jpg" width="280" height="174" alt=""/>
                <img src="img/depo3.jpg" width="280" height="174" alt=""/>
                </section>
            </section>
            
            <footer id="container-footer">
       	    <img src="img/bmg-rodape.png" width="900" height="109" alt=""/>
            </footer>
</section>
</body>
</html>
