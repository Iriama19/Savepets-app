<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AnimalAdoption $animalAdoption
 */
?>
   <!-- ======= Breadcrumbs ======= -->
   <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?= __('Consular') ?></h2>

          <ol>
            <aside class="column">
                <div class="side-nav">
                <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> / 
                <?= $this->Html->link(__('Añadir'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>/
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $animalAdoption->id], ['class' => 'side-nav-item']) ?>  / 
                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $animalAdoption->id], ['confirm' => __('Estas seguro que quieres borrar la adopción de {1} a {0}?', $animalAdoption->animal->name, $animalAdoption->user->name), 'class' => 'side-nav-item']) ?>                 </div>
            </aside>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->
     <!-- ======= Individual Section ======= -->
 <section id="individual" class="individual">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2> <?= __('Los datos') ?> </h2>
      <p> <?= __('sobre') ?> <span><?= h('adopción') ?></span>!!</p>
    </div>

    <div class="row g-0">
    <?php
      $imageAnimal=$animalAdoption->animal->image;
      if(!empty($imageAnimal)&& !preg_match('/^animal-img\/$/',$imageAnimal)){ 
        $dir='/img/'.$imageAnimal;
    ?>
        <div class="col-lg-4 reservation-img" style="background-image: url(<?php echo $dir ?>);" data-aos="zoom-out" data-aos-delay="200"></div>

    <?php }else{ ?>
      <div class="col-lg-4 reservation-img" style="background-image: url(/img/animalabout.png);" data-aos="zoom-out" data-aos-delay="200"></div>
     <?php } ?>

      <div class="col-lg-8 d-flex align-items-center reservation-form-bg">
        <form action="forms/individual.php" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
                <h5><?= __('Animal') ?>:</h5>
                <?= $animalAdoption->has('animal') ? $this->Html->link($animalAdoption->animal->name, ['controller' => 'Animal', 'action' => 'view', $animalAdoption->animal->id]) : '' ?>              
                <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5><?= __('Usuario') ?>:</h5>
                <?= $animalAdoption->has('user') ? $this->Html->link($animalAdoption->user->name, ['controller' => 'Address', 'action' => 'view', $animalAdoption->user->addres_id]) : '' ?>              
                <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6">
              <h5><?= __('Fecha inicio') ?>:</h5>
                <?= h($animalAdoption->start_date) ?>
                <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5><?= __('Fecha fin') ?>:</h5>
                <?= h($animalAdoption->end_date) ?>
                <div class="validate"></div>
            </div>
          </div>
        </form>
      </div><!-- End Form -->
      <br>
    <div>    
  </div>
 </div>
<br><br>