<?php

    class Message {

        public static function forError($errorcode) {
            $msg = "<div class='alert alert-danger alert-message'>";
            switch ($_GET["error"]) {
                /* Error messages for login */
                case 1001:
                  $msg .= "<strong>Login nicht möglich!</strong> Es wurden keine Daten eingegeben.";
                  break;
                case 1002:
                  $msg .= "<strong>Login nicht möglich!</strong> Ein interner Fehler ist aufgetreten.";
                  break;
                case 1003:
                  $msg .= "<strong>Login nicht möglich!</strong> Benutzername unbekannt oder Passwort nicht korrekt.";
                  break;

                /* Error messages for upload */
                case 2001:
                  $msg .= "<strong>Upload nicht möglich!</strong> Die angegebene Datei ist keine Bilddatei.";
                  break;
                case 2002:
                  $msg .= "<strong>Upload nicht möglich!</strong> Datei existiert bereits am Server.";
                  break;
                case 2003:
                  $msg .= "<strong>Upload nicht möglich!</strong> Die maximale Dateigröße von 2 MB wurde überschritten.";
                  break;
                case 2004:
                  $msg .= "<strong>Upload nicht möglich!</strong> Unerlaubter Dateityp, bitte nur JPG, JPEG, PNG & GIF-Dateien hochladen.";
                  break;

                /* Error messages for delete */
                case 3001:
                  $msg .= "<strong>Löschen nicht möglich!</strong> Es wurden noch keine Bilddateien hochgeladen.";
                  break;

                /* Default error message for unknown error code */
                default:
                  $msg .= "<strong>Aktion konnte nicht durchgeführt werden!</strong> Es ist ein unbekannter Fehler aufgetreten.";
            }
            $msg .= "</div>\n";
            return $msg;
        }

        public static function success_upload() {
            return "<div class='alert alert-success alert-message'>Datei wurde erfolgreich hochgeladen!</div>";
        }

        public static function success_delete() {
            return "<div class='alert alert-success alert-message'>Alle Bilder wurden erfolgreich gelöscht!</div>";
        }
    }

 ?>
