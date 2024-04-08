<?php
// Este arquivo faz parte do Moodle - http://moodle.org/
//
// O Moodle é um software livre: você pode redistribuí-lo e/ou
// modificá-lo conforme os termos da Licença Pública Geral GNU publicada pela
// Free Software Foundation, tanto a versão 3 da Licença como (a seu critério)
// qualquer versão posterior.
//
// O Moodle é distribuído na esperança de que seja útil,
// mas SEM NENHUMA GARANTIA; sem uma garantia implícita de
// COMERCIALIZAÇÃO ou de ADEQUAÇÃO A UMA FINALIDADE ESPECÍFICA. Consulte a
// Licença Pública Geral GNU para obter mais detalhes.
//
// Você deve ter recebido uma cópia da Licença Pública Geral GNU
// juntamente com o Moodle. Se não, consulte <http://www.gnu.org/licenses/>.

require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/../classes/block_todays_birthday.php');

// Verificar se o usuário está logado
require_login();

// Configurar a página
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Aniversariantes do Dia');
$PAGE->set_heading('Aniversariantes do Dia');

// Iniciar a saída HTML
echo $OUTPUT->header();

// Criar uma instância do bloco
$block_instance = new \block_todays_birthday();

// Renderizar o conteúdo do bloco
echo $block_instance->get_content()->text;

// Finalizar a saída HTML
echo $OUTPUT->footer();
?>
