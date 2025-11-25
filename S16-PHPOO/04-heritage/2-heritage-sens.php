<?php 

class A {
    public function testA() {
        return "testA";
    }
}

//  --------------

class B extends A {
    public function testB()
    {
        return "testB";
    }
}

// -----------------

class C extends B {
    public function testC() 
    {
        return "testC";
    }
}

$c = new C;
var_dump(get_class_methods($c));

/* 
    Si C hérite de B 
        que B hérite de A 
            alors C hérite de A même s'il n'y a pas de lien direct entre les deux 

    C'est la transitivité !  

    On dit aussi de l'héritage : 

        - Non reflexif : class D extends D // Pas possible, une classe ne peut pas hériter d'elle même 
        - Non symétrique : class F extends E  // F hérite de E, mais E n'hérite pas de F 
        - Sans cycle : class X extends Y   je ne peux pas faire après class Y extends X  
        - Pas d'héritage multiple : class G extends I, J, K
            - La limitation des héritages multiples est contournée par l'existence des Traits

*/