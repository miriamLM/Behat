*Nota Práctica Final:* 8/10

* Los steps para hacer las peticiones a los endpoints son correctos
* Estas haciendo comprobaciones sobre las respuestas, que esta genial, pero los steps son confusos,
por lo que pone aquí
```
    And the color response should be:
    """
    green
    """
```
Yo espero que la respuesta del endpoint siempre me devuelva el color verde, sin embargo el step `theColorResponseShouldBe`
lo que hace es comprobar que lo que le pasas es un string y luego, sin tocar ese valor que tu has pasado,
comprobar que la respuesta del endpoint está dentro de unos valores válidos. Lo mismo pasa con el step `theCoolwordResponseShouldBe`

*Nota Final:* 8,7