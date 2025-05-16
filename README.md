# 🐧 Sette opp Ubuntu i en virtuell maskin (VirtualBox)

Dette dokumentet forklarer hvordan du installerer og setter opp Ubuntu i en virtuell maskin ved hjelp av **VirtualBox**.

---

## 📦 Forutsetninger

Før du begynner trenger du følgende:

- En datamaskin med Windows, macOS eller Linux
- Internett-tilkobling
- [VirtualBox](https://www.virtualbox.org/) installert
- Ubuntu ISO-fil (last ned fra [ubuntu.com](https://ubuntu.com/download))

---

## 📥 Steg 1: Last ned Ubuntu

1. Gå til: https://ubuntu.com/download
2. Velg ønsket versjon (f.eks. Ubuntu Desktop 24.04 LTS)
3. Klikk "Download" og lagre `.iso`-filen

---

## 🛠️ Steg 2: Installer og start VirtualBox

1. Last ned og installer VirtualBox fra https://www.virtualbox.org/
2. Start VirtualBox etter installasjon

---

## 🖥️ Steg 3: Opprett en ny virtuell maskin

1. Klikk **"New"** / "Ny"
2. Navngi maskinen, f.eks. `Ubuntu`
3. Velg:
   - **Type:** Linux
   - **Versjon:** Ubuntu (64-bit)
4. Klikk **Next**

---

## 💾 Steg 4: Angi minne (RAM)

1. Velg minst **2048 MB (2 GB)** RAM
2. Anbefalt: 4096 MB for bedre ytelse
3. Klikk **Next**

---

## 💽 Steg 5: Opprett virtuell harddisk

1. Velg **"Create a virtual hard disk now"**
2. Klikk **Create**
3. Velg **VDI (VirtualBox Disk Image)** og klikk **Next**
4. Velg **Dynamically allocated** og klikk **Next**
5. Velg diskstørrelse (minst 25 GB anbefales), og klikk **Create**

---

## 🔗 Steg 6: Koble til Ubuntu ISO

1. Velg den nye VM-en i listen, og klikk **Settings**
2. Gå til **Storage**
3. Klikk på **"Empty"** under "Controller: IDE"
4. Klikk på CD-ikonet til høyre > **Choose a disk file**
5. Velg ISO-filen du lastet ned
6. Klikk **OK**

---

## ▶️ Steg 7: Start installasjonen

1. Klikk **Start**
2. Følg Ubuntu-installasjonsveiviseren:
   - Velg språk
   - Klikk "Install Ubuntu"
   - Velg tastaturoppsett
   - Velg installasjonstype
   - Opprett brukerkonto
   - Fullfør installasjonen

---

## ⏳ Steg 8: Fullfør og restart

1. Når installasjonen er ferdig, velg **Restart Now**
2. Før restart: Gå til **Devices > Optical Drives > Remove disk from virtual drive**
3. Trykk Enter etter "Please remove the installation medium" hvis nødvendig

---

## ✅ Klar til bruk!

Ubuntu er nå installert og klart til bruk i din virtuelle maskin! 🎉

---

## 🧠 Tips

- Installer **Guest Additions** for:
  - Bedre skjermoppløsning
  - Klipp og lim mellom vert og gjest
  - Delte mapper
- Kjør følgende kommandoer i terminalen for å holde systemet oppdatert:

```bash
sudo apt update && sudo apt upgrade
