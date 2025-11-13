import React from "react";
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "../../../../components/ui/accordion";

const faqData = [
  {
    id: "item-1",
    question: "Qual é o primeiro passo para financiar um imóvel?",
    answer:
      "O primeiro passo é realizar uma análise da sua capacidade financeira. Verificamos sua renda, comprometimento atual com outras dívidas e histórico de crédito para determinar o valor que você pode financiar com segurança.",
    defaultOpen: true,
  },
  {
    id: "item-2",
    question: "Posso usar meu FGTS para comprar um imóvel?",
    answer: "",
    defaultOpen: false,
  },
  {
    id: "item-3",
    question: "Quanto tempo leva todo o processo de compra?",
    answer: "",
    defaultOpen: false,
  },
  {
    id: "item-4",
    question: "Quais documentos são necessários para iniciar o processo?",
    answer: "",
    defaultOpen: false,
  },
];

export const FAQsSection = (): JSX.Element => {
  return (
    <section className="w-full flex flex-col bg-[#fff8ef] py-10 px-4 md:px-8 lg:px-16 translate-y-[-1rem] animate-fade-in opacity-0">
      <div className="max-w-[1440px] mx-auto w-full flex flex-col items-center">
        <h2 className="bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] [-webkit-background-clip:text] bg-clip-text [-webkit-text-fill-color:transparent] [text-fill-color:transparent] [font-family:'Archivo_Narrow',Helvetica] font-bold italic text-transparent text-[40px] tracking-[0] leading-[normal] mb-6 opacity-0 animate-fade-in [--animation-delay:200ms]">
          DUVIDAS FREQUENTES
        </h2>

        <p className="[font-family:'Roboto',Helvetica] font-normal text-[#6e1010] text-[23px] tracking-[0] leading-[23.0px] text-center max-w-[739px] mb-14 opacity-0 animate-fade-in [--animation-delay:400ms]">
          Tire suas principais duvidas sobre financiamento e processo de compra.
        </p>

        <Accordion
          type="single"
          collapsible
          defaultValue="item-1"
          className="w-full max-w-[984px] space-y-[35px] opacity-0 animate-fade-in [--animation-delay:600ms]"
        >
          {faqData.map((faq, index) => (
            <AccordionItem
              key={faq.id}
              value={faq.id}
              className="bg-[#f7f7f7] rounded-[50px] border border-solid border-[#cfcfcf] shadow-[4px_4px_10.4px_#00000030] px-20 py-6 transition-colors"
            >
              <AccordionTrigger className="hover:no-underline [&[data-state=open]>svg]:rotate-180">
                <span className="[font-family:'Roboto',Helvetica] font-medium text-[#373b47] text-[23px] tracking-[0] leading-[23.0px] text-left">
                  {faq.question}
                </span>
              </AccordionTrigger>
              {faq.answer && (
                <AccordionContent className="pt-4">
                  <div className="flex gap-4">
                    <img
                      className="w-px h-[50px] object-cover flex-shrink-0"
                      alt="Line"
                      src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-13.svg"
                    />
                    <p className="[font-family:'Roboto',Helvetica] font-normal text-[#373b47] text-base tracking-[0] leading-[16.0px]">
                      {faq.answer}
                    </p>
                  </div>
                </AccordionContent>
              )}
            </AccordionItem>
          ))}
        </Accordion>
      </div>
    </section>
  );
};
