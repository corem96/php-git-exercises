<?php

namespace Bookstore\Domain;
  
Interface Customer extends Payer {
    public function getMonthlyFee() : float;
    public function getAmountToBorrow() : int;
    public function getType() : string;
  }

?>