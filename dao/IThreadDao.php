<?php

/*
// thread lancé par la couche [dao]
public interface IThreadDao extends Runnable {
// le thread doit connaître la couche [dao]
public void setDao(IDao dao);
}
 */

/**
 *
 * @author usrlocal
 */
interface IThreadDao extends Thread {
  public function setDao($dao);
}

?>
