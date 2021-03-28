<?php
/*
Template Name: Страница контакты
Template Post Type: page
*/
get_header();
?>
<section class="section-dark">
  <div class="container">
    <?php the_title('<h1 class="page-title">', '</h1>', true); ?>
    <div class="contacts-wrapper">
      <div class="left-contact-left">
        <h2 class="contacts-title">Через форму обратной связи</h2>
        <!-- <p>Заполните форму обратной связи</p> -->
        <!-- <form action="#" class="contacts-form" method="POST">
          <input name="contact_name" type="text" class="input contacts-input" placeholder="Ваше имя">
          <input name="contact_email" type="email" class="input contacts-input" placeholder="Ваш Email">
          <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос"></textarea>
          <button type="submit" class="button more">Отправить</button>
        </form> -->
        <?php the_content(); ?>
      </div>
      <!-- /.left -->
      <div class="contact-right">
        <h2 class="contacts-title">Или по этим контактам</h2>
        <!-- <?php
                  // проверяем есть ли email
        $email = get_post_meta( get_the_ID(), 'email', true);
        if ($email) {echo '<a href="mailto:' . $email . '">' . $email . ' </a>';}
                 // проверяем есть ли адресс
        $address = get_post_meta( get_the_ID(), 'address', true);
        if ($address) { echo '<address>' . $address . '</address>';}
                 // проверяем есть ли телефон
        $phone = get_post_meta( get_the_ID(), 'phone', true);
        if ($phone) { echo '<a href="tel:' . $phone . '">' . $phone . ' </a>';}
        ?> -->
        <?php
        $email = get_field('email');
        if ($email) {echo '<a href="mailto:' . $email . '">' . $email . ' </a>';}

        $address = get_field('adress');
        if ($address) { echo '<address>' . $address . '</address>';}

        $phone = get_field('phone');
        if ($phone) { echo '<a href="tel:' . $phone . '">' . $phone . ' </a>';}

        ?>
        
      </div>
      <!-- /.right -->
    </div>
    <!-- /.contacts-wrapper -->
  </div>
  <!-- /.container -->
</section>
<!-- /.section-dark -->
<?php get_footer(); ?>