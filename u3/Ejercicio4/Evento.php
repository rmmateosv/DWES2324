<?php
    class Evento{
        private string $fecha;
        private string $hora;
        private string $asunto;

        public function __construct($fecha,$hora,$asunto){
            $this->fecha=$fecha;
            $this->hora=$hora;
            $this->asunto=$asunto;
        }
        

        /**
         * Get the value of fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Get the value of hora
         */ 
        public function getHora()
        {
                return $this->hora;
        }

        /**
         * Set the value of hora
         *
         * @return  self
         */ 
        public function setHora($hora)
        {
                $this->hora = $hora;

                return $this;
        }

        /**
         * Get the value of asunto
         */ 
        public function getAsunto()
        {
                return $this->asunto;
        }

        /**
         * Set the value of asunto
         *
         * @return  self
         */ 
        public function setAsunto($asunto)
        {
                $this->asunto = $asunto;

                return $this;
        }
    }
?>