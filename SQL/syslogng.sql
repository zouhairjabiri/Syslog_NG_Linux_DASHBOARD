-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 03 juin 2019 à 16:58
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `syslogng`
--

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `host` varchar(32) DEFAULT NULL,
  `facility` varchar(10) DEFAULT NULL,
  `priority` varchar(10) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `tag` varchar(10) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `program` varchar(220) DEFAULT NULL,
  `msg` text,
  `seq` int(15) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logs`
--

INSERT INTO `logs` (`host`, `facility`, `priority`, `level`, `tag`, `datetime`, `program`, `msg`, `seq`) VALUES
('192.168.1.15', 'syslog', 'notice', 'notice', '2d', '2019-05-28 17:02:06', 'syslog-ng', 'syslog-ng starting up; version=\'3.13.2\'', 2),
('192.168.1.14', 'syslog', 'debug', 'debug', '2d', '2019-05-28 17:05:06', 'syslog-ng', 'syslog-ng starting up; version=\'3.13.2\'', 656),
('192.168.1.14', 'authpriv', 'debug', 'debug', '55', '2019-05-28 17:05:06', 'sudo', '      gi : TTY=pts/0 ; PWD=/var/log/syslog-ng ; USER=root ; COMMAND=/usr/sbin/service syslog-ng restart', 657),
('192.168.1.14', 'authpriv', 'warning', 'warning', '56', '2019-05-28 17:05:06', 'sudo', 'pam_unix(sudo:session): session opened for user root by (uid=0)', 658),
('192.168.1.14', 'daemon', 'warning', 'warning', '1e', '2019-05-28 17:05:06', 'systemd', 'Stopping System Logger Daemon...', 659),
('192.168.1.14', 'daemon', 'warning', 'warning', '1e', '2019-05-28 17:05:06', 'systemd', 'Stopped System Logger Daemon.', 660),
('192.168.1.14', 'daemon', 'warning', 'warning', '1e', '2019-05-28 17:05:06', 'systemd', 'Starting System Logger Daemon...', 661),
('192.168.1.14', 'daemon', 'warning', 'warning', '1e', '2019-05-28 17:05:06', 'systemd', 'Started System Logger Daemon.', 662),
('192.168.1.14', 'authpriv', 'warning', 'warning', '56', '2019-05-28 17:05:06', 'sudo', 'pam_unix(sudo:session): session closed for user root', 663),
('192.168.1.14', 'user', 'debug', 'debug', '0d', '2019-05-28 17:05:06', 'gi', 'mymessage', 664),
('192.168.1.14', 'daemon', 'warning', 'warning', '1c', '2019-05-28 17:05:06', 'rtkit-daemon', 'The canary thread is apparently starving. Taking action.', 665),
('192.168.1.14', 'daemon', 'warning', 'warning', '1e', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoting known real-time threads.', 666),
('192.168.1.14', 'daemon', 'debug', 'debug', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1820 of process 1802 (n/a).', 667),
('192.168.1.14', 'daemon', 'erreur', 'erreur', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1819 of process 1802 (n/a).', 668),
('192.168.1.15', 'daemon', 'erreur', 'erreur', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1802 of process 1802 (n/a).', 669),
('192.168.1.15', 'daemon', 'erreur', 'erreur', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoted 3 threads.', 670),
('192.168.1.15', 'daemon', 'warning', 'warning', '1c', '2019-05-28 17:05:06', 'rtkit-daemon', 'The canary thread is apparently starving. Taking action.', 671),
('192.168.1.15', 'daemon', 'critical', 'critical', '1e', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoting known real-time threads.', 672),
('192.168.1.15', 'daemon', 'alert', 'alert', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1820 of process 1802 (n/a).', 673),
('192.168.1.15', 'daemon', 'alert', 'alert', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1819 of process 1802 (n/a).', 674),
('192.168.1.15', 'daemon', 'alert', 'alert', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1802 of process 1802 (n/a).', 675),
('192.168.1.15', 'daemon', 'alert', 'alert', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoted 3 threads.', 676),
('192.168.1.14', 'syslog', 'critical', 'critical', '2b', '2019-05-28 17:05:06', 'syslog-ng', 'Error running SQL query; type=\'mysql\', host=\'localhost\', port=\'\', user=\'root\', database=\'syslogng\', criticalor=\'1406: Data too long for column \\\'program\\\' at row 1\', query=\'INSERT INTO logs (host, facility, priority, level, tag, program, msg) VALUES (\\\'192.168.1.14\\\', \\\'local0\\\', \\\'warning\\\', \\\'warning\\\', \\\'84\\\', \\\'/usr/lib/gdm3/gdm-x-session\\\', \\\'(EE) client bug: timer event3 debounce: offset negative (-10184ms)\\\')\'', 683),
('192.168.1.14', 'user', 'alert', 'alert', '0d', '2019-05-28 17:05:06', 'gi', 'chouf db', 684),
('192.168.1.14', 'daemon', 'warning', 'warning', '1c', '2019-05-28 17:05:06', 'rtkit-daemon', 'The canary thread is apparently starving. Taking action.', 685),
('192.168.1.16', 'daemon', 'critical', 'critical', '1e', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoting known real-time threads.', 686),
('192.168.1.16', 'daemon', 'alert', 'alert', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1820 of process 1802 (n/a).', 687),
('192.168.1.16', 'daemon', 'alert', 'alert', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1819 of process 1802 (n/a).', 688),
('192.168.1.16', 'daemon', 'alert', 'alert', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1802 of process 1802 (n/a).', 689),
('192.168.1.16', 'daemon', 'alert', 'alert', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoted 3 threads.', 690),
('192.168.1.16', 'syslog', 'critical', 'critical', '2b', '2019-05-28 17:05:06', 'syslog-ng', 'Error running SQL query; type=\'mysql\', host=\'localhost\', port=\'\', user=\'root\', database=\'syslogng\', criticalor=\'1406: Data too long for column \\\'program\\\' at row 1\', query=\'INSERT INTO logs (host, facility, priority, level, tag, program, msg) VALUES (\\\'192.168.1.16\\\', \\\'local0\\\', \\\'warning\\\', \\\'warning\\\', \\\'84\\\', \\\'/usr/lib/gdm3/gdm-x-session\\\', \\\'(EE) client bug: timer event3 debounce: offset negative (-10184ms)\\\')\'', 691),
('192.168.1.16', 'daemon', 'warning', 'warning', '1c', '2019-05-28 17:05:06', 'rtkit-daemon', 'The canary thread is apparently starving. Taking action.', 692),
('192.168.1.16', 'daemon', 'info', 'info', '1e', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoting known real-time threads.', 693),
('192.168.1.16', 'daemon', 'emergency', 'emergency', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1820 of process 1802 (n/a).', 694),
('192.168.1.16', 'daemon', 'emergency', 'emergency', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1819 of process 1802 (n/a).', 695),
('192.168.1.16', 'daemon', 'emergency', 'emergency', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1802 of process 1802 (n/a).', 696),
('192.168.1.16', 'daemon', 'emergency', 'emergency', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoted 3 threads.', 697),
('192.168.1.16', 'syslog', 'critical', 'critical', '2b', '2019-05-28 17:05:06', 'syslog-ng', 'Error running SQL query; type=\'mysql\', host=\'localhost\', port=\'\', user=\'root\', database=\'syslogng\', error=\'1406: Data too long for column \\\'program\\\' at row 1\', query=\'INSERT INTO logs (host, facility, priority, level, tag, program, msg) VALUES (\\\'192.168.1.16\\\', \\\'local0\\\', \\\'warning\\\', \\\'warning\\\', \\\'84\\\', \\\'/usr/lib/gdm3/gdm-x-session\\\', \\\'(EE) client bug: timer event3 debounce: offset negative (-10184ms)\\\')\'', 698),
('192.168.1.16', 'daemon', 'warning', 'warning', '1c', '2019-05-28 17:05:06', 'rtkit-daemon', 'The canary thread is apparently starving. Taking action.', 699),
('192.168.1.16', 'daemon', 'info', 'info', '1e', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoting known real-time threads.', 700),
('192.168.1.16', 'daemon', 'emergency', 'emergency', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1820 of process 1802 (n/a).', 701),
('192.168.1.16', 'daemon', 'emergency', 'emergency', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1819 of process 1802 (n/a).', 702),
('192.168.1.16', 'daemon', 'emergency', 'emergency', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1802 of process 1802 (n/a).', 703),
('192.168.1.16', 'daemon', 'emergency', 'emergency', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoted 3 threads.', 704),
('192.168.1.16', 'daemon', 'warning', 'warning', '1c', '2019-05-28 17:05:06', 'rtkit-daemon', 'The canary thread is apparently starving. Taking action.', 705),
('192.168.1.16', 'daemon', 'info', 'info', '1e', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoting known real-time threads.', 706),
('192.168.1.16', 'daemon', 'notice', 'notice', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1820 of process 1802 (n/a).', 707),
('192.168.1.14', 'daemon', 'notice', 'notice', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1819 of process 1802 (n/a).', 708),
('192.168.1.14', 'daemon', 'notice', 'notice', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Successfully demoted thread 1802 of process 1802 (n/a).', 709),
('192.168.1.14', 'daemon', 'notice', 'notice', '1d', '2019-05-28 17:05:06', 'rtkit-daemon', 'Demoted 3 threads.', 710),
('192.168.1.14', 'syslog', 'debug', 'debug', '2b', '2019-05-28 17:05:06', 'syslog-ng', 'Error running SQL query; type=\'mysql\', host=\'localhost\', port=\'\', user=\'root\', database=\'syslogng\', debug=\'1406: Data too long for column \\\'program\\\' at row 1\', query=\'INSERT INTO logs (host, facility, priority, level, tag, program, msg) VALUES (\\\'192.168.1.14\\\', \\\'local0\\\', \\\'warning\\\', \\\'warning\\\', \\\'84\\\', \\\'/usr/lib/gdm3/gdm-x-session\\\', \\\'(EE) client bug: timer event3 debounce: offset negative (-10184ms)\\\')\'', 711),
('192.168.1.14', 'syslog', 'debug', 'debug', '2b', '2019-05-28 17:05:06', 'syslog-ng', 'Multiple failures while inserting this record into the database, message dropped; attempts=\'3\'', 712),
('192.168.1.14', 'daemon', 'warning', 'warning', '1c', '2019-05-28 17:05:06', 'rtkit-daemon', 'The canary thread is apparently starving. Taking action.', 713),
('192.168.1.16', 'syslog', 'notice', 'notice', '2d', '2019-05-28 17:02:06', 'syslog-ng', 'syslog-ng starting up; version=\'3.13.2\'', 15953),
('192.168.1.15', 'syslog', 'notice', 'notice', '2d', '2019-05-28 17:02:06', 'syslog-ng', 'Syslog connection established; fd=\'15\', server=\'AF_INET(192.168.1.11:54230)\', local=\'AF_INET(0.0.0.0:0)\'', 15954),
('192.168.1.14', 'daemon', 'info', 'info', '1e', '2019-05-28 17:01:45', 'systemd', 'Stopping System Logger Daemon...', 15955),
('192.168.1.14', 'auth', 'notice', 'notice', '25', '2019-05-28 17:01:48', 'audit', 'AVC apparmor=\"STATUS\" operation=\"profile_replace\" info=\"same as current profile, skipping\" profile=\"unconfined\" name=\"/snap/core/6818/usr/lib/snapd/snap-confine\" pid=3819 comm=\"apparmor_parser\"', 15956),
('192.168.1.15', 'kern', 'notice', 'notice', '05', '2019-05-28 17:01:48', 'kernel', 'audit: type=1400 audit(1559062908.669:69): apparmor=\"STATUS\" operation=\"profile_replace\" info=\"same as current profile, skipping\" profile=\"unconfined\" name=\"/snap/core/6818/usr/lib/snapd/snap-confine\" pid=3819 comm=\"apparmor_parser\"', 15957),
('192.168.1.16', 'kern', 'notice', 'notice', '05', '2019-05-28 17:01:48', 'kernel', 'audit: type=1400 audit(1559062908.669:70): apparmor=\"STATUS\" operation=\"profile_replace\" info=\"same as current profile, skipping\" profile=\"unconfined\" name=\"/snap/core/6818/usr/lib/snapd/snap-confine//mount-namespace-capture-helper\" pid=3819 comm=\"apparmor_parser\"', 15958),
('192.168.1.15', 'auth', 'notice', 'notice', '25', '2019-05-28 17:01:48', 'audit', 'AVC apparmor=\"STATUS\" operation=\"profile_replace\" info=\"same as current profile, skipping\" profile=\"unconfined\" name=\"/snap/core/6818/usr/lib/snapd/snap-confine//mount-namespace-capture-helper\" pid=3819 comm=\"apparmor_parser\"', 15959),
('192.168.1.14', 'auth', 'notice', 'notice', '25', '2019-05-28 17:01:49', 'audit', 'AVC apparmor=\"STATUS\" operation=\"profile_replace\" info=\"same as current profile, skipping\" profile=\"unconfined\" name=\"snap-update-ns.core\" pid=3822 comm=\"apparmor_parser\"', 15960),
('192.168.1.15', 'kern', 'notice', 'notice', '05', '2019-05-28 17:01:49', 'kernel', 'audit: type=1400 audit(1559062909.021:71): apparmor=\"STATUS\" operation=\"profile_replace\" info=\"same as current profile, skipping\" profile=\"unconfined\" name=\"snap-update-ns.core\" pid=3822 comm=\"apparmor_parser\"', 15961),
('192.168.1.15', 'auth', 'notice', 'notice', '25', '2019-05-28 17:01:49', 'audit', 'AVC apparmor=\"STATUS\" operation=\"profile_replace\" info=\"same as current profile, skipping\" profile=\"unconfined\" name=\"snap.core.hook.configure\" pid=3823 comm=\"apparmor_parser\"', 15962),
('192.168.1.16', 'kern', 'notice', 'notice', '05', '2019-05-28 17:01:49', 'kernel', 'audit: type=1400 audit(1559062909.113:72): apparmor=\"STATUS\" operation=\"profile_replace\" info=\"same as current profile, skipping\" profile=\"unconfined\" name=\"snap.core.hook.configure\" pid=3823 comm=\"apparmor_parser\"', 15963),
('192.168.1.15', 'daemon', 'info', 'info', '1e', '2019-05-28 17:01:51', 'snapd', 'daemon.go:379: started snapd/2.38.1 (series 16; classic) ubuntu/18.10 (amd64) linux/4.18.0-10-generic.', 15964),
('192.168.1.16', 'daemon', 'info', 'info', '1e', '2019-05-28 17:01:54', 'systemd', 'Started Snappy daemon.', 15965),
('192.168.1.14', 'daemon', 'info', 'info', '1e', '2019-05-28 17:01:57', 'systemd', 'Stopped System Logger Daemon.', 15966),
('192.168.1.15', 'daemon', 'info', 'info', '1e', '2019-05-28 17:01:57', 'systemd', 'Starting System Logger Daemon...', 15967),
('192.168.1.16', 'daemon', 'info', 'info', '1e', '2019-05-28 17:02:06', 'systemd', 'Started System Logger Daemon.', 15968),
('192.168.1.14', 'user', 'notice', 'notice', '0d', '2019-05-28 17:02:51', 'gi', 'je suis Le serveur 192.168.1.14', 15973),
('192.168.1.14', 'daemon', 'warning', 'warning', '1e', '2019-05-28 17:05:06', 'dbus-daemon', '[system] Successfully activated service \'org.freedesktop.hostname1\'', 15980);

-- --------------------------------------------------------

--
-- Structure de la table `loguser`
--

CREATE TABLE `loguser` (
  `id` int(4) NOT NULL,
  `user` varchar(20) DEFAULT NULL,
  `log_in` datetime DEFAULT NULL,
  `log_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `loguser`
--

INSERT INTO `loguser` (`id`, `user`, `log_in`, `log_out`) VALUES
(11, 'admin1', '2019-06-02 15:53:49', '2019-06-02 15:53:50'),
(12, 'admin1', '2019-06-02 15:54:27', '2019-06-02 15:54:29'),
(13, 'admin2', '2019-06-02 16:07:58', '2019-06-02 16:08:00'),
(14, 'admin2', '2019-06-03 00:44:01', '2019-06-03 00:44:32');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `numtel` int(10) DEFAULT NULL,
  `serveurIP` varchar(12) DEFAULT NULL,
  `issu` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `numtel`, `serveurIP`, `issu`) VALUES
(1, 'Zouhair', 'JABIRI', 'admin', 'admin', 'admin@admin.com', 3546, NULL, 1),
(2, 'admin1', 'admin1', 'admin1', 'admin1', 'admin1', 354622, '192.168.1.14', 0),
(3, 'admin2', 'admin2', 'admin2', 'admin2', 'admin2', 354622, '192.168.1.15', 0),
(5, 'admin3', 'admin3', 'admin3', 'admin3', 'admin3', 0, '192.168.1.16', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`seq`);

--
-- Index pour la table `loguser`
--
ALTER TABLE `loguser`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `seq` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15981;

--
-- AUTO_INCREMENT pour la table `loguser`
--
ALTER TABLE `loguser`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
