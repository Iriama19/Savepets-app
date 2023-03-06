<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FosterListUser $fosterListUser
 */
?>

   <!-- ======= Breadcrumbs ======= -->
   <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?= __('Editar') ?></h2>
          <ol>
            <aside class="column">
                <div class="side-nav">
                <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> /
                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $fosterListUser->id], 
                    ['confirm' => __('Estas seguro de querer eliminar la participación en la lista de acogida de la protectora {0}?', $fosterListUser->foster_list->user->username), 'class' => 'side-nav-item']) ?>                 </div>
            </aside>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= Form Section ======= -->
    <section id="formsec" class="formsec">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p><?= __('Editar') ?> <span><?= __('opciones de lista de acogida') ?></span></p>
        </div>
        <div class="section-content-form">
      
              <img src="/img/about-2.jpg" class="img-fluid" alt="">

          <?= $this->Form->create($fosterListUser,['type'=>'file','class'=>'php-email-form p-3 p-md-4']) ?>
           
          <div class="row">
                <div class="col-xl-6 form-group">
                    <?php 
                        $opciones=['cat' => __('Gato'),'dog' => __('Perro'),'bunny' => __('Conejo'),'hamster' => __('Hamster'),'snake' => __('Serpiente'),'turtles'=> __('Tortuga'),'other' => __('Otro') ,'indifferent'=> __('Indiferente')];
                        echo $this->Form->control('specie',['class'=>'form-control','label'=> __('Especie'),'options'=>$opciones]); 
                    ?>
                </div>
            </div>
            <br>            <div class="col-xl-6 form-group">
              <?php 
                echo $this->Form->control('foster_date',['class'=>'form-control', 'label' =>'Fecha de acogida']); 
              ?>
            </div><br>
            <div class="text-center"><?= $this->Form->button(__('Editar')) ?></div>

            <?= $this->Form->end() ?>
          <!--End Form -->
        </div>

      </div>
    </section><!-- End Form Section -->

