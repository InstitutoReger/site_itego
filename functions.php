<?php

function remove_useless_stuff() {
    if ( !is_admin() ) {
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
    }
}
add_action( 'init', 'remove_useless_stuff', PHP_INT_MAX - 1 );

  // Adiciona suporte às imagens destacdas
  add_theme_support('post-thumbnails');
  //Adiciona suporte ao menu
  add_theme_support('menus');
  
add_action( 'after_setup_theme', 'theme_functions' );
function theme_functions() {


  // Adiciona <title> às páginas
  add_theme_support('title-tag');


}

// Cria link no painel: Configurações personalizadas
function redes_sociais_add_menu() {
  add_menu_page( 'Redes Sociais', 'Redes Sociais', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99);
}
add_action( 'admin_menu', 'redes_sociais_add_menu' );

// Customiza a logo na página de login
function custom_logo_login() {
    echo '
        <style>
            .login h1 a { background-image: url(wp-admin/images/logo_itego.png) !important; background-size: 234px 67px; width:234px; height:67px; display:block; }
        </style>
    ';
}
add_action( 'login_head', 'custom_logo_login' );

// Cria página das redes sociais no painel
function custom_settings_page() { ?>
  <div class="wrap">
    <h1>Redes Sociais</h1>
    <form method="post" action="options.php">
       <?php
           settings_fields('section');
           do_settings_sections('theme-options');      
           submit_button(); 
       ?>          
    </form>
  </div>
<?php }


// Twitter
function setting_twitter() { ?>
  <input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>" />
<?php }
function setting_facebook() { ?>
  <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }
function setting_youtube() { ?>
  <input type="text" name="youtube" id="youtube" value="<?php echo get_option('youtube'); ?>" />
<?php }
function setting_instagram() { ?>
  <input type="text" name="instagram" id="instagram" value="<?php echo get_option('instagram'); ?>" />
<?php }

//Função que salva o conteúdo da página de redes sociais
function custom_settings_page_setup() {
  add_settings_section('section', 'All Settings', null, 'theme-options');
  add_settings_field('twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section');
  add_settings_field('facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section');
  add_settings_field('youtube', 'Youtube URL', 'setting_youtube', 'theme-options', 'section');
  add_settings_field('instagram', 'Instagram', 'setting_instagram', 'theme-options', 'section');

  register_setting('section', 'twitter');
  register_setting('section', 'facebook');
  register_setting('section', 'youtube');
  register_setting('section', 'instagram');
}
add_action( 'admin_init', 'custom_settings_page_setup' );

//cria custom post-type para os arquivos da transparência e página de eventos
function create_post_type() {
    register_post_type( 'transparencia',
        array(
            'labels' => array(
                'name' => __( 'Transparência' ),
                'singular_name' => __( 'Transparência' )
            ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-aside',
        )
    );

    register_post_type( 'pesquisa',
        array(
            'labels' => array(
                'name' => __( 'Pesquisa' ),
                'singular_name' => __( 'Pesquisa' )
            ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-aside',
        )
    );
    
    register_post_type( 'eventos',
        array(
            'labels' => array(
                'name' => __( 'Eventos' ),
                'singular_name' => __( 'Eventos' )
            ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        )
    );

    register_post_type( 'processo-seletivo',
        array(
            'labels' => array(
                'name' => __( 'Processo Seletivo' ),
                'singular_name' => __( 'Processo Seletivo' )
            ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-write-blog',
        )
    );
}
add_action( 'init', 'create_post_type' );


//categorias específicas para processo seletivo
function themes_taxonomy() {  
  register_taxonomy(  
    'tipo',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
    'processo-seletivo',        //post  type name
    array( 
      'show_in_nav_menus' => true,
      'hierarchical' => true,  
      'label' => 'Tipo',  //Display name
      'query_var' => true,
      'rewrite' => array(
        'slug' => 'tipo', // This controls the base slug that will display before each term
        'with_front' => true
      )
    )  
  );
}
add_action('init', 'themes_taxonomy');


//funcao para gerar um excerpt com menos caracteres
function get_excerpt(){
  $excerpt = get_the_content();
  $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, 150);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
  return $excerpt;
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);


//adicione classe active ao menu
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


//correção para a paginação da página de processos seletivos
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'filter_opt_posts_per_page', 0);
function filter_opt_posts_per_page() {
  add_filter( 'option_posts_per_page', 'opt_posts_per_page' );
}

function opt_posts_per_page( $value ) {
  global $option_posts_per_page;
  if ( is_tax( 'tipo') ) {
    return 2;
  } else {
    return $option_posts_per_page;
  }
}


//chama o masked só na página de vestibular
add_action('wp_enqueue_scripts', 'itegoalf_enqueue_masked_input');
function itegoalf_enqueue_masked_input(){
  if(
    is_page('edital-028-2020-inscricao') || 
    is_page('edital-029-2020-inscricao') ||
    is_page('edital-030-2020-inscricao') ||
    is_page('edital-031-2020-inscricao') ||
    is_page('edital-032-2020-inscricao') ||
    is_page('edital-033-2020-inscricao') ||
    is_page('edital-034-2020-inscricao') ||
    is_page('edital-035-2020-inscricao') ||
    is_page('edital-036-2020-inscricao') ||
    is_page('edital-037-2020-inscricao') ||
    is_page('edital-038-2020-inscricao') ||
    is_page('edital-039-2020-inscricao') ||
    is_page('edital-040-2020-inscricao') ||
    is_page('edital-041-2020-inscricao') ||
    is_page('edital-042-2020-inscricao') ||
    is_page('edital-043-2020-inscricao') ||
    is_page('edital-044-2020-inscricao') ||
    is_page('edital-045-2020-inscricao') ||
    is_page('edital-046-2020-inscricao') ||
    is_page('edital-047-2020-inscricao') ||
    is_page('edital-048-2020-inscricao') ||
    is_page('edital-050-2020-inscricao') ||
    is_page('edital-051-2020-inscricao') ||
    is_page('edital-052-2020-inscricao') ||
    is_page('edital-001-2021-ead-inscricao') ||
    is_page('edital-002-2021-ead-inscricao') ||
    is_page('edital-001-2021-inscricao') ||
    is_page('edital-002-2021-inscricao') ||
    is_page('edital-003-2021-inscricao')
  ){
    wp_enqueue_script('masked-input', get_template_directory_uri().'/js/jquery.maskedinput.min.js', array('jquery'));
  }
if(is_page('questionario-perfil') || is_page('questionario-abandono') || is_page('questionario-egressos')){
   wp_enqueue_script('masked-input', get_template_directory_uri().'/js/jquery.maskedinput.min.js', array('jquery'));
   wp_enqueue_script('masked-money', get_template_directory_uri().'/js/jquery.maskMoney.js', array('jquery'));
  }
}

//vamos iniciar o masked no input de cpf
add_action('wp_footer', 'itegoalf_activate_masked_input');

function itegoalf_activate_masked_input(){
   if( is_page('formulario-de-inscricao-incubadora')){
?>
    <script type="text/javascript">
      jQuery( function($){
        $("#telefone").mask("(99) 9999-9999?9").focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
          })
      });
    </script>
<?php 
   }
   if(is_page('questionario-perfil')){ ?>
    <script type="text/javascript">
      jQuery( function($){
        $("#qst_cpf").mask("999.999.999-99");
        $('#pgt13').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
    });
    </script>
  <?}

   if(is_page('questionario-abandono')){ ?>
    <script type="text/javascript">
      jQuery( function($){
        $("#qa_cpf").mask("999.999.999-99");
        $('#fld6').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
    });
    </script>
  <?}

   if(is_page('questionario-egressos')){ ?>
    <script type="text/javascript">
      jQuery( function($){
        $("#qe_cpf").mask("999.999.999-99");
        $('#qe_12').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
    });
    </script>
  <?}
  if (
    is_page('edital-028-2020-inscricao') || 
    is_page('edital-029-2020-inscricao') ||
    is_page('edital-030-2020-inscricao') ||
    is_page('edital-031-2020-inscricao') ||
    is_page('edital-032-2020-inscricao') ||
    is_page('edital-033-2020-inscricao') ||
    is_page('edital-034-2020-inscricao') ||
    is_page('edital-035-2020-inscricao') ||
    is_page('edital-036-2020-inscricao') ||
    is_page('edital-037-2020-inscricao') ||
    is_page('edital-038-2020-inscricao') ||
    is_page('edital-039-2020-inscricao') ||
    is_page('edital-040-2020-inscricao') ||
    is_page('edital-041-2020-inscricao') ||
    is_page('edital-042-2020-inscricao') ||
    is_page('edital-043-2020-inscricao') ||
    is_page('edital-044-2020-inscricao') ||
    is_page('edital-045-2020-inscricao') ||
    is_page('edital-046-2020-inscricao') ||
    is_page('edital-047-2020-inscricao') ||
    is_page('edital-048-2020-inscricao') ||
    is_page('edital-050-2020-inscricao') ||
    is_page('edital-051-2020-inscricao') ||
    is_page('edital-052-2020-inscricao') ||
    is_page('edital-001-2021-ead-inscricao') ||
    is_page('edital-002-2021-ead-inscricao') ||
    is_page('edital-001-2021-inscricao') ||
    is_page('edital-002-2021-inscricao') ||
    is_page('edital-003-2021-inscricao')

  ){?>
    <script type="text/javascript">
      jQuery( function($){
          $("#cpf").mask("999.999.999-99");
          $("#cpfresponsavel").mask("999.999.999-99");
          $("#cpfmae").mask("999.999.999-99");
          $("#cpfpai").mask("999.999.999-99");
          $("#celularpai").mask("(99) 99999-9999");
          $("#celularmae").mask("(99) 99999-9999");
          $("#celularresponsavel").mask("(99) 99999-9999");
          $("#whatsapp").mask("(99) 99999-9999");
          $("#telres").mask("(99) 9999-9999");
          $("#telcel").mask("(99) 9999-99999");
          $("#dataemissaotitulo").mask('99/99/9999');
          $("#dataemissao").mask("99/99/9999");
          $("#nascimento").mask("99/99/9999");
          $("#cep").mask("99.999-999");
    });
    </script>
  <? }
}


/**
 * @param $formName string
 * @param $fieldName string
 * @param $fieldValue string
 * @return bool
 */

function is_already_submitted($formName, $fieldName, $fieldValue) {
    require_once(ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php');
    $exp = new CFDBFormIterator();
    $atts = array();
    $atts['show'] = $fieldName;
    $atts['filter'] = "$fieldName=$fieldValue";
    $atts['unbuffered'] = 'true';
    $exp->export($formName, $atts);
    $found = false;
    while ($row = $exp->nextRow()) {
        $found = true;
    }
    return $found;
}
 
//verifica se já existe o cpf na tabela de inscrições
function itegoalf_validacampo($result, $tag) {
    $formName = 'Incubadora'; // Nome do fórmulário
    $fieldName = 'email'; // Campo que será validado
    $errorMessage = 'Este email já está inscrito na incubadora!'; // Mensagem de erro
    $name = $tag['name'];


    if ($name == $fieldName) {
        if (is_already_submitted($formName, $fieldName, $_POST[$name])) {
            $result->invalidate($tag, $errorMessage);
        }
    }
    return $result;
}


// Chama a função que fará a validação
add_filter('wpcf7_validate_email*', 'itegoalf_validacampo', 10, 2);


//move o arquivo do formulário para as pastas
function cfdbFilterSaveFiles($formData) {
 
  $frmead = 'Edital 01/2020 - Técnico em Logística Presencial';
  if (($formData && $frmead == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/docs-2020/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/docs-2020/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('boletimenem','boletimem ');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  } 

  $frmead3 = 'Edital 039/2020';
  if (($formData && $frmead3 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/3920/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/3920/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivotitulo', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

    $frm40 = 'Edital 040/2020';
  if (($formData && $frm40 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4020/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4020/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivotitulo', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

      $frm41 = 'Edital 041/2020';
  if (($formData && $frm41 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4120/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4120/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivotitulo', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm42 = 'Edital 042/2020';
  if (($formData && $frm42 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4220/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4220/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivotitulo', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm43 = 'Edital 043/2020';
  if (($formData && $frm43 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4320/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4320/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivotitulo', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm44 = 'Edital 044/2020';
  if (($formData && $frm44 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4420/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4420/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm45 = 'Edital 045/2020';
  if (($formData && $frm45 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4520/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4520/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm46 = 'Edital 046/2020';
  if (($formData && $frm46 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4620/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4620/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm47 = 'Edital 047/2020';
  if (($formData && $frm47 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4720/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4720/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm48 = 'Edital 048/2020';
  if (($formData && $frm48 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/4820/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/4820/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm50 = 'Edital 050/2020';
  if (($formData && $frm50 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/5020/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/5020/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm51 = 'Edital 051/2020';
  if (($formData && $frm51 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/5120/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/5120/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

  $frm52 = 'Edital 052/2020';
  if (($formData && $frm52 == $formData->title)){

    // CHANGE THIS: directory where the file will be saved permanently
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/5220/';

    // CHANGE THIS: URL to the above directory
    $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/5220/';

    // CHANGE THIS: upload field names on your form
    $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

    return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
  }

    $frm1ead = 'Edital 001-2021 Ead';

    if ($formData && $frm1ead == $formData->title){

        // CHANGE THIS: directory where the file will be saved permanently
        $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/01-21-ead/';

        // CHANGE THIS: URL to the above directory
        $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/01-21-ead/';

        // CHANGE THIS: upload field names on your form
      $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

        return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
    }

    $frm2ead = 'Edital 002-2021 Ead';

    if ($formData && $frm2ead == $formData->title){

        // CHANGE THIS: directory where the file will be saved permanently
        $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/02-21-ead/';

        // CHANGE THIS: URL to the above directory
        $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/02-21-ead/';

        // CHANGE THIS: upload field names on your form
      $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

        return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
    }

    $frm0121 = 'Edital 001-2021';

    if ($formData && $frm0121 == $formData->title){

        // CHANGE THIS: directory where the file will be saved permanently
        $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/0121/';

        // CHANGE THIS: URL to the above directory
        $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/0121/';

        // CHANGE THIS: upload field names on your form
      $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

        return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
    }

    $frm0221 = 'Edital 002-2021';

    if ($formData && $frm0221 == $formData->title){

        // CHANGE THIS: directory where the file will be saved permanently
        $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/labibefaiad/wp-content/uploads/0221/';

        // CHANGE THIS: URL to the above directory
        $urlDir = 'http://itego.com.br/labibefaiad/wp-content/uploads/0221/';

        // CHANGE THIS: upload field names on your form
      $fieldNames = array('comp_endereco','comp_ensino', 'arquivorg-frente', 'arquivorg-verso', 'arquivocpf');

        return saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames);
    }
  return $formData;
}

function saveFilesInForm($formData, $uploadDir, $urlDir, $fieldNames) {

  // make a copy of data from cf7
  $formCopy = clone $formData;

  foreach ($fieldNames as $fieldName) {
      if (isset($formData->uploaded_files[$fieldName])) {

          // breakdown parts of uploaded file, to get basename
          $path = pathinfo($formCopy->uploaded_files[$fieldName]);
          // directory of the new file
          $newfile = $uploadDir . $path['basename'];

          // check if a file with the same name exists in the directory
          if (file_exists($newfile)) {
              $dupname = true;
              $i = 2;
              while ($dupname) {
                  $newpath = pathinfo($newfile);
                  $newfile = $uploadDir . $newpath['filename'] . '-' . $i . '.' . $newpath['extension'];
                  if (file_exists($newfile)) {
                      $i++;
                  } else {
                      $dupname = false;
                  }
              }
          }

          // make a copy of file to new directory
          copy($formCopy->uploaded_files[$fieldName], $newfile);

          // save the path to the copied file to the cfdb database
          $formCopy->posted_data[$fieldName] = $newfile;

          $path = pathinfo($newfile);
          $formCopy->posted_data[$fieldName . '-url'] = $urlDir . $path['basename'];

          // delete the original file from $formCopy
          unset($formCopy->uploaded_files[$fieldName]);
      }

  }
  return $formCopy;
}

add_filter('cfdb_form_data', 'cfdbFilterSaveFiles');

function buscacpf_inscricaotec2820($result, $tag) {
  $formName = 'Edital 028/2020'; // Nome do fórmulário
  $fieldName = 'cpf2820'; // Campo que será validado
  $errorMessage = 'Este CPF já realizou uma inscrição!'; // Mensagem de erro
  $name = $tag['name'];

  if ($name == $fieldName) {
      if (is_already_submitted($formName, $fieldName, $_POST[$name])) {
          $result->invalidate($tag, $errorMessage);
      }
  }
  return $result;
}
 
// Chama a função que fará a validação
add_filter('wpcf7_validate_text*', 'buscacpf_inscricaotec2820', 10, 2);

function buscacpf_inscricao3720($result, $tag) {
  $formName = 'Edital 037/2020'; // Nome do fórmulário
  $fieldName = 'cpf3720'; // Campo que será validado
  $errorMessage = 'Este CPF já realizou uma inscrição!'; // Mensagem de erro
  $name = $tag['name'];

  if ($name == $fieldName) {
      if (is_already_submitted($formName, $fieldName, $_POST[$name])) {
          $result->invalidate($tag, $errorMessage);
      }
  }
  return $result;
}
 
// Chama a função que fará a validação
add_filter('wpcf7_validate_text*', 'buscacpf_inscricao3720', 10, 2);

function buscacpf_inscricao3920($result, $tag) {
  $formName = 'Edital 039/2020'; // Nome do fórmulário
  $fieldName = 'cpf3920'; // Campo que será validado
  $errorMessage = 'Este CPF já realizou uma inscrição!'; // Mensagem de erro
  $name = $tag['name'];

  if ($name == $fieldName) {
      if (is_already_submitted($formName, $fieldName, $_POST[$name])) {
          $result->invalidate($tag, $errorMessage);
      }
  }
  return $result;
}
 
// Chama a função que fará a validação
add_filter('wpcf7_validate_text*', 'buscacpf_inscricao3920', 10, 2);