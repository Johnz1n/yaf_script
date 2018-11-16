<?php

$pcap = $argv[1];
$active_timeout = $argv[2];
$idle_timeout = $argv[3];
$fcap = "captura_".$active_timeout."_".$idle_timeout.".fcap";
$flow = "captura_".$active_timeout."_".$idle_timeout.".flow";
shell_exec("yaf --in ".$pcap." --out ".$fcap." --active-timeout ".$active_timeout." --idle-timeout ".$idle_timeout." --uniflow");
shell_exec("yafscii --in ".$fcap." --out ".$flow." --tabular");

$file = fopen($flow, "r");
$fluxos = 0;
$duration = 0;
$pkts = 0;
$pico_pkt_76 = 0;
$pico_pkt_107 = 0;
$oct = 0;
$pico_oct_76 = 0;
$pico_oct_107 = 0;
$flow = 0;
$avg_pkt_duration = 0;
$avg_oct_duration = 0;

if ($file) {
    while (($line = fgets($file)) !== false) {
        $line = explode("|", $line);
        $fluxos++;
        $duration += (double) $line[2];
        $pkts += (int) $line[17];
        $oct += (int) $line[18];
        $pkt_duration = (int) $line[17]/(double) $line[2];
        $avg_pkt_duration += $pkt_duration;
        $oct_duration = (int) $line[18]/(double) $line[2];
        $avg_oct_duration += $oct_duration;
        if (trim($line[5], " ") == "128.160.78.76") {
            if ($pico_pkt_76 < $pkt_duration) {
                $pico_pkt_76 = $pkt_duration;
            }
            if ($pico_oct_76 < $oct_duration) {
                $pico_oct_76 = $oct_duration;
            }
        }
        else if (trim($line[5], " ") == "128.170.241.107") {
            if ($pico_pkt_107 < $pkt_duration) {
                $pico_pkt_107 = $pkt_duration;
            }
            if ($pico_oct_107 < $oct_duration) {
                $pico_oct_107 = $oct_duration;
            }
        }
    }
    fclose($file);
} else {
    return ("Ops, algo de errado não está certo");
} 

print_r($pcap." Active = ".$active_timeout." Idle ".$idle_timeout."\n");
print_r("1 - Quantos registros de fluxos são exportados? ".$fluxos."\n");
print_r("2 - Qual a duração média dos registros de fluxo? ".$duration/$fluxos."\n");
print_r("3 - Qual a quantidade média de pacotes por registro de fluxos?".$pkts/$fluxos."\n");
print_r("4 - Qual é a taxa de transmissão média, em pacotes por segundo, dos registros de fluxo? ".$avg_pkt_duration/$fluxos."\n");
print_r("5 - Qual é o pico de taxa de transmissão, em pacotes por segundo, para os registros de fluxo com endereço IP de origem 128.160.78.76? ".$pico_pkt_76."\n");
print_r("6 - Qual é o pico de taxa de transmissão, em pacotes por segundo, para os registros de fluxo com endereço IP de origem 128.170.241.107? ".$pico_pkt_107."\n");
print_r("7 - Qual a quantidade média de bytes por registro de fluxo? ".$oct/$fluxos."\n");
print_r("8 - Qual é a taxa de transmissão média, em bytes por segundo, dos registros de fluxo? ".$avg_oct_duration/$fluxos."\n");
print_r("9 - Qual é o pico de taxa de transmissão, em bytes por segundo, para os registros de fluxo com endereço IP de origem? ".$pico_oct_76."\n");
print_r("10 -Qual é o pico de taxa de transmissão, em bytes por segundo, para os registros de fluxo com endereço IP de origem 128.170.241.107? ".$pico_oct_107."\n\n");