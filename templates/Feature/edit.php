<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feature $feature
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
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $feature->id], ['confirm' => __('Estas seguro que quieres borrar la característica {0}?', $feature->key_feature), 'class' => 'side-nav-item']) ?>                 </div>
            </aside>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= Form Section ======= -->
    <section id="formsec" class="formsec">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p><?= __('Editar') ?> <span><?= h($feature->key_feature) ?></span></p>
        </div>
        <div class="section-content-form">            
              <img src="/img/animalabout.png" class="img-fluid" alt="">

          <?= $this->Form->create($feature,['type'=>'file','class'=>'php-email-form p-3 p-md-4']) ?>
           
          <div class="row">
                <div class="col-xl-6 form-group">
                    <?php echo $this->Form->control('key_feature',['class'=>'form-control','label'=> __('Clave')]); ?>
                </div>
            <br>
            <br>
            <div class="text-center"><?= $this->Form->button(__('Editar')) ?></div>

            <?= $this->Form->end() ?>
          <!--End Form -->
        </div>

      </div>
    </section><!-- End Form Section -->
