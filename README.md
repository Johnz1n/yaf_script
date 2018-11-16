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

Install php

```sh
sudo apt install php
```

### Run Script

```sh
php script.php active_time idle_time
```