class FrontTools{
    // Guardado de sesiones para persistencia de datos
    setStorage(key, value) {
        try {
            if (typeof value == 'object') {
                sessionStorage.setItem(key, JSON.stringify(value));
            }
            else {
                sessionStorage.setItem(key, `${value}`);
            }
            return true; // Indica que la operación fue exitosa
        } catch (error) {
            console.error('Error al guardar en sessionStorage:', error);
            return false; // Indica que hubo un error
        }
    }

    // Método para obtener un valor de sessionStorage
    getStorage(key) {
        try {
            const value = sessionStorage.getItem(key);
            if (this.verifyJsonStringify(value)) {
                return JSON.parse(value);
            }
            else {
                return value;
            }
        } catch (error) {
            console.error('Error al obtener de sessionStorage:', error);
            return null; // Indica que hubo un error
        }
    }

    // Método para eliminar un valor de sessionStorage
    removeStorage(key) {
        try {
            sessionStorage.removeItem(key);
            return true; // Indica que la operación fue exitosa
        } catch (error) {
            console.error('Error al eliminar de sessionStorage:', error);
            return false; // Indica que hubo un error
        }
    }

    // Este método verifica si el valor es un string con un json stringinificado o un string a secas
    verifyJsonStringify(stringValue) {
        try {
            // esto significa que el valor verificado es un json stringnificado
            JSON.parse(stringValue);
            return true;
        }
        catch (Exception) {
            // en este caso es solo un string
            return false;
        }
    }
    // Fin persistencia de datos

    // funciones con strings
    reemplazarAcentos(text) {
        const sustitutions = {
          àáâãäå: "a",
          ÀÁÂÃÄÅ: "A",
          èéêë: "e",
          ÈÉÊË: "E",
          ìíîï: "i",
          ÌÍÎÏ: "I",
          òóôõö: "o",
          ÒÓÔÕÖ: "O",
          ùúûü: "u",
          ÙÚÛÜ: "U",
          ýÿ: "y",
          ÝŸ: "Y",
          ß: "ss",
          ñ: "n",
          Ñ: "N"
        };
        // Devuelve un valor si 'letter' esta incluido en la clave
        function getLetterReplacement(letter, replacements) {
          const findKey = Object.keys(replacements).reduce(
            (origin, item, index) => (item.includes(letter) ? item : origin),
            false
          );
          return findKey !== false ? replacements[findKey] : letter;
        }
        // Recorre letra por letra en busca de una sustitución
        return text.split("").map((letter) => getLetterReplacement(letter, sustitutions)).join("");
    }

    truncateString(string, numero) {
        if (string.length > numero) {
            return string.slice(0, numero) + "...";
        } else {
            return string;
        }
    }

    getSpinnerSMTemplate(){
        return `<div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        `
    }
    // fin funciones con string

    // helpers
    randomID() {
        var S4 = function() {
           return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
        };
        return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
    }

    diaDeLaSemana(fecha){
        let dia = [
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado',
        'Domingo'][new Date(fecha).getDay()];
        return dia;
    }
    // fin helpers
}


