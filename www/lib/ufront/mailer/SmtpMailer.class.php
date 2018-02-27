<?php

// Generated by Haxe 3.4.4
class ufront_mailer_SmtpMailer implements ufront_mailer_UFMailer{
	public function __construct($server) {
		if(!php_Boot::$skip_constructor) {
		$this->host = $server->host;
		$tmp = null;
		if($server->port !== null) {
			$tmp = $server->port;
		} else {
			$tmp = 25;
		}
		$this->port = $tmp;
		$this->authUser = $server->user;
		$this->authPassword = $server->pass;
	}}
	public $host;
	public $port;
	public $authUser;
	public $authPassword;
	public function send($email) {
		return new tink_core__Future_SyncFuture(new tink_core__Lazy_LazyConst($this->sendSync($email)));
	}
	public function sendSync($email) {
		$p = null;
		$numAttachments = $email->images->length + $email->attachments->length;
		$tmp = null;
		if($email->text !== null) {
			$tmp = $email->html !== null;
		} else {
			$tmp = false;
		}
		if($tmp) {
			$p = new mtwin_mail_Part("multipart/alternative", false, $email->charset);
			$t = $p->newPart("text/plain");
			$h = $p->newPart("text/html");
			$t->setContent($email->text);
			$h->setContent($email->html);
		} else {
			$tmp1 = null;
			if($email->text !== null) {
				$tmp1 = $numAttachments > 0;
			} else {
				$tmp1 = false;
			}
			if($tmp1) {
				$p = new mtwin_mail_Part("multipart/alternative", false, $email->charset);
				$t1 = $p->newPart("text/plain");
				$t1->setContent($email->text);
			} else {
				if($email->text !== null) {
					$p = new mtwin_mail_Part("text/plain", false, $email->charset);
					$p->setContent($email->text);
				} else {
					$tmp2 = null;
					if($email->html !== null) {
						$tmp2 = $numAttachments > 0;
					} else {
						$tmp2 = false;
					}
					if($tmp2) {
						$p = new mtwin_mail_Part("multipart/alternative", false, $email->charset);
						$h1 = $p->newPart("text/html");
						$h1->setContent($email->html);
					} else {
						if($email->html !== null) {
							$p = new mtwin_mail_Part("text/html", false, $email->charset);
							$p->setContent($email->html);
						} else {
							$tmp3 = null;
							$tmp4 = null;
							if($email->text === null) {
								$tmp4 = $email->html === null;
							} else {
								$tmp4 = false;
							}
							if($tmp4) {
								$tmp3 = $numAttachments > 0;
							} else {
								$tmp3 = false;
							}
							if($tmp3) {
								$p = new mtwin_mail_Part("multipart/alternative", false, $email->charset);
								$t2 = $p->newPart("text/plain");
								$t2->setContent("");
							} else {
								$tmp5 = null;
								$tmp6 = null;
								if($email->text === null) {
									$tmp6 = $email->html === null;
								} else {
									$tmp6 = false;
								}
								if($tmp6) {
									$tmp5 = $numAttachments === 0;
								} else {
									$tmp5 = false;
								}
								if($tmp5) {
									$p = new mtwin_mail_Part("text/plain", false, $email->charset);
									$p->setContent("");
								}
							}
						}
					}
				}
			}
		}
		$p->setHeader("Subject", $email->subject);
		$p->setDate($email->date);
		{
			$_g = 0;
			$_g1 = $email->getHeaders();
			while($_g < $_g1->length) {
				$header = $_g1[$_g];
				$_g = $_g + 1;
				$p->addHeader($header->a, $header->b);
				unset($header);
			}
		}
		$addAttachments = array(new _hx_lambda(array(&$p), "ufront_mailer_SmtpMailer_0"), 'execute');
		call_user_func_array($addAttachments, array($email->images));
		call_user_func_array($addAttachments, array($email->attachments));
		$printList = array(new _hx_lambda(array(), "ufront_mailer_SmtpMailer_1"), 'execute');
		$this1 = $email->fromAddress;
		$tmp7 = null;
		$tmp8 = null;
		if(ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($this1) !== null) {
			$tmp8 = ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($this1) !== "";
		} else {
			$tmp8 = false;
		}
		if($tmp8) {
			$tmp9 = "\"" . _hx_string_or_null(ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($this1)) . "\" <";
			$tmp7 = _hx_string_or_null($tmp9) . _hx_string_or_null(ufront_mail__EmailAddress_EmailAddress_Impl_::get_email($this1)) . ">";
		} else {
			$tmp7 = ufront_mail__EmailAddress_EmailAddress_Impl_::get_email($this1);
		}
		$p->setHeader("From", $tmp7);
		if($email->replyToAddress !== null) {
			$this2 = $email->replyToAddress;
			$tmp10 = null;
			$tmp11 = null;
			if(ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($this2) !== null) {
				$tmp11 = ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($this2) !== "";
			} else {
				$tmp11 = false;
			}
			if($tmp11) {
				$tmp12 = "\"" . _hx_string_or_null(ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($this2)) . "\" <";
				$tmp10 = _hx_string_or_null($tmp12) . _hx_string_or_null(ufront_mail__EmailAddress_EmailAddress_Impl_::get_email($this2)) . ">";
			} else {
				$tmp10 = ufront_mail__EmailAddress_EmailAddress_Impl_::get_email($this2);
			}
			$p->setHeader("Reply-To", $tmp10);
		}
		if($email->toList->length > 0) {
			$tmp13 = call_user_func_array($printList, array($email->toList));
			$p->setHeader("To", $tmp13);
		}
		if($email->ccList->length > 0) {
			$tmp14 = call_user_func_array($printList, array($email->ccList));
			$p->setHeader("Cc", $tmp14);
		}
		$_g3 = (new _hx_array(array()));
		{
			$_g11 = 0;
			$_g21 = (new _hx_array(array($email->toList, $email->ccList, $email->bccList)));
			while($_g11 < $_g21->length) {
				$list1 = $_g21[$_g11];
				$_g11 = $_g11 + 1;
				{
					$address = $list1->iterator();
					while($address->hasNext()) {
						$address1 = $address->next();
						if($address1 !== null) {
							$_g3->push(ufront_mail__EmailAddress_EmailAddress_Impl_::get_email($address1));
						}
						unset($address1);
					}
					unset($address);
				}
				unset($list1);
			}
		}
		$toList = $_g3;
		$tmp15 = $this->host;
		$tmp16 = ufront_mail__EmailAddress_EmailAddress_Impl_::get_email($email->fromAddress);
		$tmp17 = $p->get();
		ufront_mailer_SmtpMailer::sendSmtp($tmp15, $tmp16, $toList, $tmp17, $this->port, $this->authUser, $this->authPassword);
		return tink_core_Outcome::Success(tink_core_Noise::$Noise);
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	static function sendSmtp($host, $from, $toList, $data, $port = null, $user = null, $password = null) {
		if($port === null) {
			$port = 25;
		}
		$cnx = new sys_net_Socket();
		try {
			$cnx->connect(new sys_net_Host($host), $port);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				$cnx->close();
				throw new HException(mtwin_mail_Exception::ConnectionError($host, $port));
			}
		}
		$supportLoginAuth = false;
		$s = $cnx->input->readLine();
		$ret = trim($s);
		$esmtp = _hx_index_of($ret, "ESMTP", null) >= 0;
		while(StringTools::startsWith($ret, "220-")) {
			$s1 = $cnx->input->readLine();
			$ret = trim($s1);
			unset($s1);
		}
		if($esmtp) {
			$cnx->write("EHLO " . _hx_string_or_null(sys_net_Host::localhost()) . "\x0D\x0A");
			$ret = "";
			while(true) {
				$s2 = $cnx->input->readLine();
				$ret = trim($s2);
				if(_hx_substr($ret, 0, 3) !== "250") {
					$cnx->close();
					throw new HException(mtwin_mail_Exception::BadResponse($ret));
				} else {
					$tmp = null;
					if(_hx_substr($ret, 4, 4) === "AUTH") {
						$tmp = _hx_index_of($ret, "LOGIN", null) !== -1;
					} else {
						$tmp = false;
					}
					if($tmp) {
						$supportLoginAuth = true;
					}
					unset($tmp);
				}
				if(!(_hx_substr($ret, 0, 4) !== "250 ")) {
					break;
				}
				unset($s2);
			}
		} else {
			$cnx->write("HELO " . _hx_string_or_null(sys_net_Host::localhost()) . "\x0D\x0A");
			$s3 = $cnx->input->readLine();
			$ret = trim($s3);
			if(_hx_substr($ret, 0, 3) !== "250") {
				$cnx->close();
				throw new HException(mtwin_mail_Exception::BadResponse($ret));
			}
		}
		if($user !== null) {
			if($supportLoginAuth) {
				$cnx->write("AUTH LOGIN\x0D\x0A");
				$s4 = $cnx->input->readLine();
				$ret = trim($s4);
				if(_hx_substr($ret, 0, 3) !== "334") {
					$cnx->close();
					throw new HException(mtwin_mail_Exception::SmtpAuthError($ret));
				}
				$cnx->write(_hx_string_or_null(mtwin_mail_Tools::encodeBase64($user)) . "\x0D\x0A");
				$s5 = $cnx->input->readLine();
				$ret = trim($s5);
				if(_hx_substr($ret, 0, 3) !== "334") {
					$cnx->close();
					throw new HException(mtwin_mail_Exception::SmtpAuthError($ret));
				}
				$cnx->write(_hx_string_or_null(mtwin_mail_Tools::encodeBase64($password)) . "\x0D\x0A");
				$s6 = $cnx->input->readLine();
				$ret = trim($s6);
				if(_hx_substr($ret, 0, 3) !== "235") {
					$cnx->close();
					throw new HException(mtwin_mail_Exception::SmtpAuthError($ret));
				}
			} else {
				throw new HException(mtwin_mail_Exception::SmtpAuthError("Authorization with 'login' method not supported by server"));
			}
		}
		$cnx->write("MAIL FROM:<" . _hx_string_or_null($from) . ">\x0D\x0A");
		$s7 = $cnx->input->readLine();
		$ret = trim($s7);
		if(_hx_substr($ret, 0, 3) !== "250") {
			$cnx->close();
			throw new HException(mtwin_mail_Exception::SmtpMailFromError($ret));
		}
		{
			$to = $toList->iterator();
			while($to->hasNext()) {
				$to1 = $to->next();
				$cnx->write("RCPT TO:<" . _hx_string_or_null($to1) . ">\x0D\x0A");
				$s8 = $cnx->input->readLine();
				$ret = trim($s8);
				if(_hx_substr($ret, 0, 3) !== "250") {
					$cnx->close();
					throw new HException(mtwin_mail_Exception::SmtpRcptToError($ret));
				}
				unset($to1,$s8);
			}
		}
		$cnx->write("DATA\x0D\x0A");
		$s9 = $cnx->input->readLine();
		$ret = trim($s9);
		if(_hx_substr($ret, 0, 3) !== "354") {
			$cnx->close();
			throw new HException(mtwin_mail_Exception::SmtpDataError($ret));
		}
		$a = _hx_deref(new EReg("\x0D?\x0A", "g"))->split($data);
		$lastEmpty = false;
		{
			$_g = 0;
			while($_g < $a->length) {
				$l = $a[$_g];
				$_g = $_g + 1;
				if(_hx_substr($l, 0, 1) === ".") {
					$l = "." . _hx_string_or_null($l);
				}
				$cnx->write($l);
				$cnx->write("\x0D\x0A");
				unset($l);
			}
		}
		if($a[$a->length - 1] !== "") {
			$cnx->write("\x0D\x0A");
		}
		$cnx->write(".\x0D\x0A");
		$s10 = $cnx->input->readLine();
		$ret = trim($s10);
		if(_hx_substr($ret, 0, 3) !== "250") {
			$cnx->close();
			throw new HException(mtwin_mail_Exception::$SmtpSendDataError);
		}
		$cnx->write("QUIT\x0D\x0A");
		$cnx->close();
	}
	function __toString() { return 'ufront.mailer.SmtpMailer'; }
}
function ufront_mailer_SmtpMailer_0(&$p, $list) {
	{
		$a = $list->iterator();
		while($a->hasNext()) {
			$a1 = $a->next();
			$aPart = $p->newPart($a1->type);
			$aPart->content = ufront_mail__EmailAttachment_EmailAttachment_Impl_::base64Encode($a1->content);
			$aPart->setHeader("Content-Type", _hx_string_or_null($a1->type) . "; name=\"" . _hx_string_or_null($a1->name) . "\"");
			$aPart->setHeader("Content-Disposition", "attachment; filename=\"" . _hx_string_or_null($a1->name) . "\"");
			$aPart->setHeader("Content-Transfer-Encoding", "base64");
			unset($aPart,$a1);
		}
	}
}
function ufront_mailer_SmtpMailer_1($l) {
	{
		$_g2 = (new _hx_array(array()));
		{
			$a2 = $l->iterator();
			while($a2->hasNext()) {
				$a3 = $a2->next();
				if($a3 !== null) {
					$printList1 = null;
					$printList2 = null;
					if(ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($a3) !== null) {
						$printList2 = ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($a3) !== "";
					} else {
						$printList2 = false;
					}
					if($printList2) {
						$printList3 = "\"" . _hx_string_or_null(ufront_mail__EmailAddress_EmailAddress_Impl_::get_name($a3)) . "\" <";
						$printList1 = _hx_string_or_null($printList3) . _hx_string_or_null(ufront_mail__EmailAddress_EmailAddress_Impl_::get_email($a3)) . ">";
						unset($printList3);
					} else {
						$printList1 = ufront_mail__EmailAddress_EmailAddress_Impl_::get_email($a3);
					}
					$_g2->push($printList1);
					unset($printList2,$printList1);
				}
				unset($a3);
			}
		}
		return $_g2->join(",");
	}
}
