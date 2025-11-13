import React from "react";
import { Card, CardContent } from "../../../../components/ui/card";

const testimonials = [
  {
    text: "Meu feedback em relação ao teu trabalho Cátia, é que nunca vi uma pessoa tão persistente ! Já havia anunciado meu apto em vários lugares e não tinha retorno. Eu já tinha desistido kkkk\nMas além de persistente, tu foste muito sincera na avaliação e na negociação do início ao final e isso é muito importante. Muito humana também, entende a necessidade de ambos os lados. Sempre que eu posso te indico pra alguém! Portanto você é uma profissional, confiável, persistente e também muito querida e atenciosa. A pessoa que anunciar ou comprar com você um empreendimento não irá se arrepender !!!",
  },
  {
    text: "Quero deixar meu feedback a respeito do ótimo atendimento que tivemos ao vender nosso apartamento, com a corretora Cátia Alexandra... Foi extremamente atenciosa, sempre a disposição pra qualquer dúvida que tínhamos. Sempre muito gentil, pontual nas visitas marcadas pra ver o imóvel. Excelente profissional e pessoa. Foi maravilhoso tê-la como corretora do nosso imóvel. Recomendo muito essa profissional que acima de tudo é muito humana, pois o ato de comprar o que vai ser nosso lar ou vender, mexe com a gente, e ter uma pessoa como ela, faz toda a diferença. Obrigada pelo excelente trabalho feito.",
  },
  {
    text: "Excelente profissional. Negociou meu apto em 40 dias. A unica corretora comprometida com o cliente.",
  },
];

export const TestimonialsSection = (): JSX.Element => {
  return (
    <section className="relative w-full bg-[#fff8ef] overflow-hidden py-16">
      <div className="absolute inset-0 -top-px">
        <img
          className="absolute top-0.5 right-0 w-full h-full object-cover"
          alt="Rectangle"
          src="https://c.animaapp.com/mht8rhtrvso9Rd/img/rectangle-8.png"
        />
        <img
          className="absolute top-px right-0 w-full h-full"
          alt="Rectangle"
          src="https://c.animaapp.com/mht8rhtrvso9Rd/img/rectangle-9.png"
        />
      </div>

      <div className="relative max-w-[1440px] mx-auto px-8">
        <h2 className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms] mb-8 bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] [-webkit-background-clip:text] bg-clip-text [-webkit-text-fill-color:transparent] [text-fill-color:transparent] [font-family:'Archivo_Narrow',Helvetica] font-bold italic text-transparent text-[45px] text-center tracking-[0] leading-[normal]">
          PALAVRAS DE CONFIOU E HOJE TEM O SONHO DA CASA PRÓPRIA REALIZADO.
        </h2>

        <p className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:400ms] mb-16 [font-family:'Roboto',Helvetica] font-normal text-[#6f6f73] text-[23px] text-center tracking-[0] leading-[23.0px] max-w-[1130px] mx-auto">
          A maioria dos meus clientes vem por indicação, Isso acontece porque
          prezamos por um atendimento transparente, honesto e com foco total em
          ajudar você a fazer a melhor escolha.
        </p>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-[1200px] mx-auto mb-6">
          {testimonials.slice(0, 2).map((testimonial, index) => (
            <Card
              key={index}
              className={`translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:${600 + index * 200}ms] bg-[#f7f7f7] rounded-[20px] border border-solid border-[#bfbfbf] shadow-[4px_4px_6px_#0000000d]`}
            >
              <CardContent className="p-6 relative">
                <div className="flex items-center justify-between mb-6">
                  <img
                    className="w-[105px] h-4"
                    alt="Frame"
                    src="https://c.animaapp.com/mht8rhtrvso9Rd/img/frame-75.svg"
                  />
                  <img
                    className="w-[70px] h-[46px]"
                    alt="Vector"
                    src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-15.svg"
                  />
                </div>
                <p className="[font-family:'Roboto',Helvetica] font-normal text-[#797979] text-sm tracking-[0] leading-[14.0px] whitespace-pre-line">
                  {testimonial.text}
                </p>
              </CardContent>
            </Card>
          ))}
        </div>

        <div className="flex justify-center max-w-[1200px] mx-auto">
          <Card className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:1000ms] w-full md:w-[466px] bg-[#f7f7f7] rounded-[20px] border border-solid border-[#bfbfbf] shadow-[4px_4px_6px_#0000000d]">
            <CardContent className="p-6 relative">
              <div className="flex items-center justify-between mb-6">
                <img
                  className="w-[105px] h-4"
                  alt="Frame"
                  src="https://c.animaapp.com/mht8rhtrvso9Rd/img/frame-75.svg"
                />
                <img
                  className="w-[70px] h-[46px]"
                  alt="Vector"
                  src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-15.svg"
                />
              </div>
              <p className="[font-family:'Roboto',Helvetica] font-normal text-[#797979] text-sm tracking-[0] leading-[14.0px]">
                {testimonials[2].text}
              </p>
            </CardContent>
          </Card>
        </div>
      </div>

      <img
        className="absolute bottom-0 left-0 w-full h-0.5"
        alt="Line"
        src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-11.svg"
      />
    </section>
  );
};
