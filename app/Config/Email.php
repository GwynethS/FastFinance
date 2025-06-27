<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $fromEmail;
    public $fromName;
    public $recipients;

    public $userAgent = 'CodeIgniter';
    public $protocol = 'smtp';
    public $mailPath = '/usr/sbin/sendmail';
    public $SMTPHost = 'smtp-mail.outlook.com';
    public $SMTPUser = 'administracion.ti@grupolozamora.com.pe';
    public $SMTPPass = 'S1ST3M4S$LOZAMORA2025';
    public $SMTPPort = 587;
    public $SMTPTimeout = 90;
    public $SMTPKeepAlive = false;
    public $SMTPCrypto = 'tls';
    public $wordWrap = true;
    public $wrapChars = 76;
    public $mailType = 'html';
    public $charset = 'UTF-8';
    public $validate = false;
    public $priority = 3;

    public $CRLF = "\r\n";
    public $newline = "\r\n";

    public $BCCBatchMode = false;
    public $BCCBatchSize = 200;
    public $DSN = false;
}
