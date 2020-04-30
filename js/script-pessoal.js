window.alert('Este Site oferece sistema Criptografia Para Seus Dados');
jQuery(document).ready(function($) {
	$(".scroll").click(function(event){
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top}, 1000);
    });
});