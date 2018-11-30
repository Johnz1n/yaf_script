# Parte 1

### Installation
Install Yaf
```sh
sudo apt update
sudo apt install gcc -y
sudo apt install libglib2.0-dev -y

wget https://tools.netsa.cert.org/releases/libfixbuf-2.1.0.tar.gz
tar -xzvf libfixbuf-2.1.0.tar.gz
cd libfixbuf-2.1.0/
./configure
sudo make
sudo make install
cd

sudo apt install libpcap-dev -y

wget https://tools.netsa.cert.org/releases/yaf-2.10.0.tar.gz
tar -xzvf yaf-2.10.0.tar.gz
cd yaf-2.10.0/
./configure
sudo make
sudo make install
cd

sudo ldconfig
```

Capture 1

```sh
wget https://wwwhome.cs.utwente.nl/~schmidtr/docs/capture.pcap
```

Choose two files [Here](https://www.simpleweb.org/wiki/index.php/Traces#Pcap_Traces).

Install php

```sh
sudo apt install php
```

### Run Script

```sh
php script.php mycapture.pcap active_time idle_time
```
Exemplo

> php script.php capture.pcap 120 60


# Parte 2 

### TCPDUMP Commands
>1) sudo tcpdump -i <interface> "icmp"
>2) sudo tcpdump -i <interface> "src <ip origem> && dst <ip destino>"
>3) sudo tcpdump -i <interface> src portrange 5000-6000 and dst portrange 5000-6000 
>4) sudo tcpdump -i wlp3s0 "((src 79.102.40.55 and src port 5000) and (dst 79.102.40.50 and dst port 3000)) or ((src 79.102.40.51:and src port 3000) and (dst 9.102.40.52 and dst port 4000))"
>5) sudo  tcpdump -i wlp3s0 -v 'src 192.168.1.45  and (tcp[tcpflags] and (tcp-rst) != 0)'
>6) sudo  tcpdump -i wlp3s0 -v 'tcp[tcpflags] & (tcp-rst) != 0 ' and src 172.30.153.186
>7) sudo  tcpdump -i wlp3s0 -v udp -B 1500
>8) sudo tcpdump -i wlp3s0 udp  port 53 and  dst 79.102.40.55
>9) sudo tcpdump -i wlp3s0 port 22 or port 21   
>10)sudo  tcpdump -i wlp3s0 'dst port 80 and dst 79.102.40.55'
