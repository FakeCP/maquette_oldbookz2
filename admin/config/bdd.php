<?php 
                    $options = array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                      );

                            $dsn = 'mysql:dbname=bdd_mathieu;host=localhost;';
                            $user = 'user_bibliotheque';
                            $password = '/wSo/)t3trFySMW_';

                            try {
                                $bdd = new PDO($dsn, $user, $password, $options);
                            } catch (PDOException $error) {
                                die('FATAL BDD ERROR');
                            }
                            