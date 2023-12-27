<?php

namespace Data;

    final class Test_data
    {
        private $input;
        private $password;
        private $time_target;
        private $cost;
        private $plain;
        public $return;

        public function __construct($data)
        {
            $this->input = htmlspecialchars($data);
            $this->input = stripslashes($this->input);
            $this->input = trim($this->input);
            $this->return = $this->input;
            $this->time_target = 0.05;
            $this->plain = $data;
        }

        public function encrypt_password()
        {
            $cost = 8;
            do {
                ++$cost;
                $start = microtime(true);
                $this->password = password_hash(stripslashes($this->input), PASSWORD_BCRYPT, ['cost' => $cost]);
                $end = microtime(true);
            } while (($end - $start) < $this->time_target);

            return $this->password;
        }

        public function recrypt_password()
        {
            $cost = 8;
            do {
                ++$cost;
                $start = microtime(true);
                if (password_needs_rehash($this->input, PASSWORD_BCRYPT, ['cost' => $cost])) {
                    return true;
                }
                $end = microtime(true);
            } while (($end - $start) < $this->time_target);

            return false;
        }

        public function decrypt_password($pass)
        {
            if (password_verify($this->plain, $pass)) {
                return true;
            }

            return false;
        }
    }

    final class Test_file
    {
        private $input;
        private $file_ex;
        private $file_cont;
        public $return;

        public function __construct($file)
        {
            $this->input = $file;
            $this->return = $this->input;
        }

        public function is_file($type)
        {
            $this->file_ex = strtolower(pathinfo($this->input['name'], PATHINFO_EXTENSION));
            if ($this->file_ex == strtolower($type)) {
                return true;
            }

            return false;
        }

        public function is_real_image()
        {
            if (@is_array(getimagesize(''.$this->input['tmp_name'].''))) {
                return true;
            }

            return false;
        }
    }

    final class Upload_file
    {
        private $target_dir;
        private $file;
        public $target_file;
        public $file_type;
        public $check;
        public $mime;
        public $size;
        public $name;
        public $auto_generated_name;
        public $generated_name;

        public function __construct($file)
        {
            $this->file = $file;
            $this->size = $file['size'];
            $this->name = htmlspecialchars(basename($file['name']));
        }

        public function set_folder($x)
        {
            $this->target_dir = $x;
            $this->target_file = $this->target_dir.basename($this->file['name']);
            $this->file_type = strtolower(pathinfo($this->target_file, PATHINFO_EXTENSION));
        }

        public function isExisting()
        {
            if (file_exists($this->target_file)) {
                return true;
            }

            return false;
        }

        public function permit($arr)
        {
            if (in_array($this->file_type, (array) $arr)) {
                return true;
            }

            return false;
        }

        public function move_to_folder()
        {
            if (move_uploaded_file($this->file['tmp_name'], $this->target_file)) {
                return true;
            }

            return false;
        }

        public function rename($name = null, $type = null)
        {
            $type = ($type == null) ? 'png' : $type;
            $type = strtolower($type);
            if ($name == null) {
                $new_name = '';
                $letters = [
                    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
                    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
                    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '_',
                ];
                $len = count($letters) - 1;
                for ($i = 0; $i < $len; ++$i) {
                    $index = rand(0, $len);
                    $new_name .= $letters[$index];
                }
                $this->auto_generated_name = $this->target_dir.$new_name.'.'.$type;
                if (rename($this->target_file, $this->auto_generated_name)) {
                    return true;
                }

                return false;
            } else {
                $this->auto_generated_name = $this->target_dir.$name.'.'.$type;
                if (rename($this->target_file, $this->target_dir.$name.'.'.$type)) {
                    return true;
                }

                return false;
            }
        }

        public function is_image()
        {
            if (@is_array(getimagesize(''.$this->file['tmp_name'].''))) {
                $this->check = getimagesize($this->file['tmp_name']);
                //$this->mime = $this->check["mime"];
                return true;
            }

            return false;
        }

        public function is_video()
        {
            if (@strstr(mime_content_type($this->file['tmp_name']), 'video/')) {
                return true;
            }

            return false;
        }
    }
    function move_file($file, $dir)
    {
        if (file_exists($file)) {
            $tmp_name = str_replace('tmp', $dir, $file);
            if (rename($file, $tmp_name)) {
                return $tmp_name;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
