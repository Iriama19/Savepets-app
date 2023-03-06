<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->loadHelper('Authentication.Identity');
if($this->Identity->isLoggedIn()){
  $currentuser = $this->request->getAttribute('identity');
  $currentuserRol=$currentuser->role;
  $currentuserUsername=$currentuser->username;
}
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" ></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
   <!-- ======= Breadcrumbs ======= -->
   <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?= __('Consultar') ?></h2>
          <ol>
            <aside class="column">
                <div class="side-nav">
                <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> 
                <?php 
                    if($this->Identity->isLoggedIn()){
                        if($currentuserRol=="admin" || $currentuserUsername==$user->username){ ?>
                         / <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>  / 
                          <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete','controller' => 'User', $user->id], 
                                    ['escape'=>false,'confirm' => __('Estas seguro de querer eliminar el usuario {0}?', $user->username)],['escape' => false]) ?> 
                <?php }
              }?>
                </div>
            </aside>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->
     <!-- ======= Individual Section ======= -->
 <section id="individual" class="individual">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2><?= __('Los datos') ?></h2>
      <p><?= __('sobre') ?> <span><?= h($user->username) ?></span>!!</p>
    </div>

    <div class="row g-0">
      <?php if($user->role=='admin'){ ?>
        <div class="col-lg-4 reservation-img" style="background-image: url(/img/logo.jpg);" data-aos="zoom-out" data-aos-delay="200"></div>
      <?php } elseif($user->role=='shelter'){ ?>
        <div class="col-lg-4 reservation-img"  data-aos="zoom-out" data-aos-delay="200">                 <div id="my-map"></div>
</div>
      <?php }else{ ?>
        <div class="col-lg-4 reservation-img" style="background-image: url(/img/useronly.png);" data-aos="zoom-out" data-aos-delay="200"></div>
      <?php } ?>

      <div class="col-lg-8 d-flex align-items-center reservation-form-bg">
        <form action="forms/individual.php" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
            <?php
            if($this->Identity->isLoggedIn()){

              if($currentuserRol=="admin" || $currentuserUsername==$user->username){ ?>
              <h5><?= __('DNI/CIF/NIE') ?></h5>
              <?= h($user->DNI_CIF) ?>
                <div class="validate"></div>
                </div><br>
              <?php }
            }  ?>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Nombre') ?>:</h5>
              <?= h($user->name) ?>
              <div class="validate"></div>
              </div><br>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Apellido') ?>:</h5>
              <?= h($user->lastname) ?>
              <div class="validate"></div>
              </div><br>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Email') ?>:</h5>
              <?= h($user->email) ?>
              <div class="validate"></div>
              </div><br>
             <?php  if($this->Identity->isLoggedIn()){

                if($currentuserRol=="admin" || $currentuserUsername==$user->username){ ?>
                  <div class="col-lg-4 col-md-6">
                    <h5><?= __('Fecha Nacimiento') ?>:</h5>
                    <?= h($user->birth_date) ?>
                    <div class="validate"></div>
                  </div><br>
                  <?php }
                  } ?>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Teléfono') ?>:</h5>
              <?= h($user->phone) ?>
              <div class="validate"></div>
              </div><br>
             <?php if($this->Identity->isLoggedIn()){

      //        if($currentuserRol=="admin" || $user->role !="shelter"|| $currentuserUsername==$user->username){ ?>
            <div class="col-lg-4 col-md-6 " id="idcountry">
              <h5><?= __('País') ?>:</h5>
             <?= h($user->addres->country) ?>
              <div class="validate"></div>
              </div><br>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Provincia') ?>:</h5>
              <?= h($user->addres->province) ?>
              <div class="validate"></div>
              </div><br>
            <div class="col-lg-4 col-md-6" id="idcity">
              <h5><?= __('Ciudad') ?>:</h5>
              <?= h($user->addres->city) ?>
              <div class="validate"></div>
              </div><br>
            <div class="col-lg-4 col-md-6" id="idstreet">
               <h5><?= __('Calle') ?>:</h5>
              <?= h($user->addres->street) ?>
              <div class="validate"></div>
              </div><br>
            <div class="col-lg-4 col-md-6"  id="idpostalcode">
              <h5><?= __('Código Postal') ?>:</h5>
              <?= h($user->addres->postal_code) ?>
              <div class="validate"></div>
            </div><br>
            <?php //}
            }
            ?>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Rol') ?></h5>
              <div hidden> <?= $rolusuario=$user->role;?> </div> 
            <?php
             switch($rolusuario){
                case "standar":
                    echo  __('Estandar');
                    break;
                case "shelter":
                    echo  __('Protectora');
                    break;
                case "admin":
                    echo  __('Admin');
                    break;
                default:
                    echo  __(' ');
                    break;
                }?>      
                
              <div class="validate"></div>
              </div><br>
              <?php if($this->Identity->isLoggedIn()){

                if($currentuserRol=="admin" || $currentuserUsername==$user->username){ ?>
             
              <div class="col-lg-4 col-md-6">
              <h5><?= __('Trabajo') ?>:</h5>
              <?= h($user->feature_user[0]->value) ?>
              <div class="validate"></div>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Estudios') ?>:</h5>
              <?= h($user->feature_user[1]->value) ?>
              <div class="validate"></div>
            </div><br>
            <div class="validate"></div>
            </div><br>
              <div class="col-lg-4 col-md-6">
              <h5><?= __('Estado Civil') ?>:</h5>
              <div hidden> <?= $maritakestatusvalue=$user->feature_user[2]->value;?> </div> 
            <?php
             switch($maritakestatusvalue){
                case "single":
                    echo  __('Soltero');
                    break;
                case "married":
                    echo  __('Casado');
                    break;
                case "divorced":
                    echo  __('Divorciado');
                    break;
                case "separated":
                  echo  __('Separado');
                  break;
                case "relationship":
                  echo  __('Relación');
                  break;
                default:
                    echo  __(' ');
                    break;
                }?> 
              <div class="validate"></div>
            </div><br>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Hijos') ?>:</h5>
              <?= h($user->feature_user[3]->value) ?>
              <div class="validate"></div>
            </div><br>
            <div class="validate"></div>
              </div><br>
              <div class="col-lg-4 col-md-6">
              <h5><?= __('Tipo de Casa') ?>:</h5>
              <div hidden> <?= $viviendavalue=$user->feature_user[4]->value;?> </div> 
            <?php
             switch($viviendavalue){
                case "detached house":
                    echo  __('Casa independiente');
                    break;
                case "semi-detached house":
                    echo  __('Chalet pareado');
                    break;
                case "terraced house":
                    echo  __('Chalet adosado');
                    break;
                case "bungalows":
                  echo  __('Bungalows');
                  break;
                case "studio":
                  echo  __('Estudio');
                  break;
                case "apartment":
                    echo  __('Apartamento');
                    break;
                case "flat":
                    echo  __('Piso');
                    break;
                case "attic":
                    echo  __('Ático');
                    break;
                case "ground floor":
                  echo  __('Bajo');
                  break;
                case "ground floor with garden":
                  echo  __('Bajo con jardín');
                  break;
                case "loft":
                    echo  __('Loft');
                    break;
                case "duplex":
                    echo  __('Dúplex');
                    break;
                case "triplex":
                  echo  __('Triplex');
                  break;
                case "quadplex":
                  echo  __('Quadplex');
                  break;
                default:
                    echo  __(' ');
                    break;
                }?> 
              <div class="validate"></div>
            </div><br>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Otras mascotas') ?>:</h5>
              <div hidden> <?= $especie=$user->feature_user[5]->value;?> </div> 
            <?php
             switch($especie){
                case "dog":
                    echo  __('Perro');
                    break;
                case "cat":
                    echo  __('Gato');
                    break;
                case "bunny":
                    echo  __('Conejo');
                    break;
                case "hamster":
                    echo  __('Hamster');
                    break;
                case "snake":
                    echo  __('Serpiente');
                    break;
                case "turtle":
                    echo  __('Tortuga');
                    break;
                case "several":
                    echo  __('Varios');
                    break;
                case "other":
                    echo  __('Otro');
                    break;
                default:
                    echo  __(' ');
                    break;
                }?>
              <div class="validate"></div>
            </div><br>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Número de mascotas') ?>:</h5>
              <?= h($user->feature_user[6]->value) ?>
              <div class="validate"></div>
            </div><br>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Genero') ?>:</h5>
              <div hidden> <?= $genero=$user->feature_user[7]->value;?> </div> 
            <?php
             switch($especie){
                case "male":
                    echo  __('Hombre');
                    break;
                case "female":
                    echo  __('Mujer');
                    break;
                case "nobinary":
                    echo  __('No binario');
                    break;
                case "other":
                    echo  __('Otro');
                    break;
                default:
                    echo  __(' ');
                    break;
                }?>
              <div class="validate"></div>
              <br>

            </div><br>
            <?php
             }
            } ?>
            <?php if($this->Identity->isLoggedIn()){
              if(($currentuserRol=="admin" || $currentuserUsername==$user->username)&&$user->role=='shelter'){ ?>
            <button type="submit" class="listbtn unirsebtn recomendar"><?= $this->Html->link(__('Análisis'), ['controller' => 'User','action' => 'analysis',$user->id,$user->username],['escape' => false]) ?></button>                                    
            <?php }
              } 
            ?>
          </div>
        </form>
      </div><!-- End Form -->
      <div>    
  </div>
 </div>
</div>
 <br>
<br>
<?= $this->Html->script(['map']) ?>
          </section>
