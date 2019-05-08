<?php 
/*
*<?= Html::img("@web/templates/images/slider/000.jpg") ?>
*<?= Html::img("@web/templates/images/slider/small/000.jpg") ?>
*/

use yii\helpers\Html; 
?>
<style>	
	ul.lof-main-wapper li {
		position:relative;	
	}
</style>
<div id="container-slider" class="hidden-md hidden-xs hidden-sm">	
    <div id="lofslidecontent45" class="lof-slidecontent">
        <div class="preload"><div></div></div>
     <!-- MAIN CONTENT --> 
          <div class="lof-main-outer">
          	<ul class="lof-main-wapper">
          	    <li>

                	<?= Html::img("@web/templates/images/slider/12.jpg") ?>            
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>
                <li>

                	<?= Html::img("@web/templates/images/slider/11.jpg") ?>            
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>
                <li>

                	<?= Html::img("@web/templates/images/slider/8.jpg") ?>            
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>
                <li>

                	<?= Html::img("@web/templates/images/slider/13.jpg") ?>            
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>
          		<li>
            		<?= Html::img("@web/templates/images/slider/1.jpg") ?>           
                     <div class="lof-main-item-desc">                      
                     </div>
                </li>
                <li>
                    <?= Html::img("@web/templates/images/slider/5.jpg") ?>           
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>  
                <li>

                	<?= Html::img("@web/templates/images/slider/4.jpg") ?>
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>  
                <li>

                	<?= Html::img("@web/templates/images/slider/7.jpg") ?>            
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>               
                <li>

                	<?= Html::img("@web/templates/images/slider/6.jpg") ?>            
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>               
                <li>

                	<?= Html::img("@web/templates/images/slider/14.jpg") ?>            
                	<div class="lof-main-item-desc">                        
                     </div>
                </li>
              </ul>  	
          </div>
          <div class="lof-navigator-outer">
          		<ul class="lof-navigator"> 
          		    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/12.jpg") ?>
                        	<h3>Ифтитоҳ</h3>
                          	<span>Ифтитоҳи маркази тестӣ...</span>
                        </div>    
                    </li> 
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/11.jpg") ?>
                        	<h3>Семинар</h3>
                          	<span>бо иштироки муовини КМТ Г.Маҳмудов, С.Раҷабова...</span>
                        </div>    
                    </li> 
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/8.jpg") ?>
                        	<h3>Садриддин Айнӣ</h3>
                          	<span>Биёед эй рафиқон дарс хонем...</span>
                        </div>    
                    </li>
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/13.jpg") ?>
                        	<h3>11.10.2017</h3>
                          	<span>Нишасти матбуотӣ</span>
                        </div>    
                    </li>                     
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/1.jpg") ?>
                        	<h3>11.10.2017</h3>
                          	<span>Семинар таҳти унвони "Раҳандози равандҳои инноватсионӣ...</span>
                        </div>    
                    </li> 
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/5.jpg") ?>
                        	<h3>Абӯабдуллоҳи Рӯдакӣ</h3>
                          	<span>Ҳар ки н-омӯхт аз гузашти рӯзгор...</span>
                        </div>    
                    </li> 
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/4.jpg") ?>
                        	<h3>22.03.2017</h3>
                          	<span>Намоиши китобҳо бахшида ба Наврӯзи Аҷам...</span>
                        </div>    
                    </li>  
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/7.jpg") ?>
                        	<h3>Эмомалӣ Раҳмон</h3>
                          	<span>Китоб аст, ки таърихи тамаддуни башарӣ...</span>
                        </div>    
                    </li> 
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/6.jpg") ?>
                        	<h3>27.06.2017</h3>
                          	<span>Намоиши китобҳо бахшида ба рӯзи Ваҳдат...</span>
                        </div>    
                    </li> 
                    <li>
                    	<div>
                        	<?= Html::img("@web/templates/images/slider/small/14.jpg") ?>
                        	<h3>27.06.2017</h3>
                          	<span>Вохӯри бо намояндогони ширкати Coco-cola...</span>
                        </div>    
                    </li>  		
                </ul>
          </div>
    </div> 
</div>
<script>
 window.onload = function() {
    $('#lofslidecontent45').lofJSidernews( { 
        interval:2900,
        duration:10,
        auto:true } );
 }
</script>
