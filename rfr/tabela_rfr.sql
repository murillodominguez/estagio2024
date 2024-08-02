-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31-Jan-2024 às 11:38
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `rfr`
--

CREATE TABLE `primarydiagnosis` (
  `id` int(11) NOT NULL,
  `matriculafunc` varchar(255) NOT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL,
  `cep` varchar(50) NOT NULL,
  `numliving` varchar(50) NOT NULL,
  `numlivingdesc` longtext CHARACTER SET utf16,
  `rentsource` longtext NOT NULL,
  `benefits` longtext NOT NULL,

  --

  `pschool0to5` varchar(20) NOT NULL,
  `pschool6to14` varchar(20) NOT NULL,
  `wschool10to17` varchar(20) NOT NULL,
  `illiteratehouseholder` varchar(20) NOT NULL,
  `momhouseholder` varchar(20) NOT NULL,
  `residentslegalagenofund` varchar(20) NOT NULL,
  `numresidentslegalagenofund` varchar(50) DEFAULT NULL,
  `habitationinhighrisk` varchar(20) NOT NULL,
  `youngineducationalmeasures` varchar(20) NOT NULL,
  `exclusionsituationpeople` varchar(20) NOT NULL,
  `incomepercapitalwrthanhalfminwage` varchar(20) NOT NULL,
  `elderlydependentfamilyincome` varchar(20) NOT NULL,
  `needsblanket` varchar(50) NOT NULL,
  `whoneedsblanket` longtext,
  `needscloth` varchar(50) NOT NULL,
  `whoneedscloth` longtext,
  
  -- BLOCO 2: CONDIÇÕES DE MORADIA
  
  `numrooms` varchar(50) NOT NULL,
  `timeofresidence` varchar(50) NOT NULL,
  `roomsraininsulation` varchar(50) NOT NULL,
  `roomscoldinsulation` varchar(50) NOT NULL,
  `roomsanimalsinsulation` varchar(50) NOT NULL,
  `residentsmostexposedandrisksituations` longtext NOT NULL,
  `courtyardanimals` varchar(50) NOT NULL,
  `courtyardanimalsconditions` varchar(100) DEFAULT NULL,
  `courtyardaccumulation` varchar(50) NOT NULL,
  `courtyardaccumulationother` longtext,
  `sharedcourtyard` varchar(50) NOT NULL,
  `courtyarddivision` varchar(50) NOT NULL,
  `specificpriorityresidencecourtyard` longtext,
  `bathroom` varchar(50) NOT NULL,
  `bathroomdrainsystem` varchar(255) DEFAULT NULL,
  `watersupplyfromwell` varchar(50) NOT NULL,
  `inadequatewastedisposal` varchar(50) NOT NULL,
  `inadequatehabitation` varchar(50) NOT NULL,
  `morethan2residentsperbedroom` varchar(50) NOT NULL,
  `habitationlocalambientalrisk` varchar(50) NOT NULL,

  -- BLOCO 3: REDE DE ATENÇÃO

  `familyubslink` varchar(50) NOT NULL,
  `familyagentecomunitariosaudelink` varchar(50) NOT NULL,
  `familycraslink` varchar(50) NOT NULL,
  `familyschoollink` varchar(50) NOT NULL,
  `familyschoollinkdesc` longtext,
  `familystudentresourceroom` varchar(50) NOT NULL,
  `familycreas` varchar(255) DEFAULT NULL,
  `familyeducationalmeasures` varchar(255) DEFAULT NULL,
  `familycasaacolhidamulher` varchar(255) DEFAULT NULL,
  `familyabrigos` varchar(255) DEFAULT NULL,
  `familyilpi` varchar(255) DEFAULT NULL,
  `familyresidenciainclusiva` varchar(255) DEFAULT NULL,
  `familyprogramacriancafeliz` varchar(255) DEFAULT NULL,
  `familynosocialservices` varchar(255) DEFAULT NULL,
  `creasdesc` longtext,
  `educationalmeasuresdesc` longtext,
  `casaacolhidamulherdesc` longtext,
  `abrigosdesc` longtext,
  `ilpidesc` longtext,
  `residenciainclusivadesc` longtext,
  `programacriancafelizdesc` longtext,
  `susambulatorio` varchar(255) DEFAULT NULL,
  `suscapsconviver` varchar(255) DEFAULT NULL,
  `suscapsad` varchar(255) DEFAULT NULL,
  `suscapsi` varchar(255) DEFAULT NULL,
  `sussrt` varchar(255) DEFAULT NULL,
  `sussantacasa` varchar(255) DEFAULT NULL,
  `sushufurg` varchar(255) DEFAULT NULL,
  `susleitossaudemental` varchar(255) DEFAULT NULL,
  `suspim` varchar(255) DEFAULT NULL,
  `susnoservices` varchar(255) DEFAULT NULL,
  `ambulatoriodesc` longtext,
  `capsconviverdesc` longtext,
  `capsaddesc` longtext,
  `capsidesc` longtext,
  `srtdesc` longtext,
  `santacasadesc` longtext,
  `hufurgdesc` longtext,
  `leitossaudementaldesc` longtext,
  `pimdesc` longtext,
  `someonetocallinurgency` varchar(50) NOT NULL,
  `someonetocallinurgencydesc` longtext,
  `religiousspaceparticipation` varchar(50) NOT NULL,
  `religiousspacedesc` longtext,
  `familygroupassistence` varchar(50) NOT NULL,
  `familygroupassistencedesc` longtext,


  -- BLOCO 4:
  `disabledhouseholderworking` varchar(50) NOT NULL,
  `housinglocalrisk` varchar(50) NOT NULL,
  `bedriddenfamilymembers` varchar(50) NOT NULL,
  `bedriddenfamilymembersdesc` longtext,
  `domiciledfamilymembers` varchar(50) NOT NULL,
  `domiciledfamilymembersdesc` longtext,
  `disabledfamilymembers` varchar(50) NOT NULL,
  `disabledfamilymembersdesc` longtext,
  `drugusersfamilymembers` varchar(50) NOT NULL,
  `drugusersfamilymembersdesc` longtext,
    -- BLOCO 5

  `howmanymealsaday` varchar(255) NOT NULL,
  `mainfoodfruits` varchar(255) DEFAULT NULL,
  `mainfoodveget` varchar(255) DEFAULT NULL,
  `mainfoodmeatfisheggs` varchar(255) DEFAULT NULL,
  `mainfoodmilkyogurt` varchar(255) DEFAULT NULL,
  `mainfoodricepasta` varchar(255) DEFAULT NULL,
  `mainfoodbean` varchar(255) DEFAULT NULL,
  `mainfoodprocessed` varchar(255) DEFAULT NULL,
  `mainfoodothers` varchar(255) DEFAULT NULL,
  `mainfoodothersdesc` varchar(255) DEFAULT NULL,
  `consumefruitsorveget` varchar(255) NOT NULL,
  `missfoodfruits` varchar(255) DEFAULT NULL,
  `missfoodveget` varchar(255) DEFAULT NULL,
  `missfoodmeateggsfish` varchar(255) DEFAULT NULL,
  `missfoodmilkyogurt` varchar(255) DEFAULT NULL,
  `missfoodricepasta` varchar(255) DEFAULT NULL,
  `missfoodbean` varchar(255) DEFAULT NULL,
  `missfoodothers` varchar(255) DEFAULT NULL,
  `missfoodothersdesc` varchar(255) DEFAULT NULL,

  -- BLOCO 6
  `needstransport` varchar(50) NOT NULL,
  `needstransportdesc` varchar(255) DEFAULT NULL,
  `needsmedication` varchar(50) NOT NULL,
  `needsmedicationdesc` varchar(255) DEFAULT NULL,
  `needsfood` varchar(50) NOT NULL,
  `needsfooddesc` varchar(255) DEFAULT NULL,
  `needsitem` longtext,
  `needseducation` longtext,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `momento` datetime DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,

  `mode` varchar(255),
  `status` varchar(255)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for table `rfr`
--
ALTER TABLE `primarydiagnosis`
  ADD KEY `id` (`id`);

--
-- AUTOINCREMENT for dumped tables
--

--
-- AUTOINCREMENT for table `rfr`
--
ALTER TABLE `primarydiagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
