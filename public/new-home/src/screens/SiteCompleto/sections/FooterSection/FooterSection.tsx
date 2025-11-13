import React from "react";

const navigationLinks = [
  { label: "Home" },
  { label: "Imóveis" },
  { label: "Contato" },
  { label: "Conteudo" },
  { label: "Quem Somos" },
  { label: "Como Funciona" },
];

const institutionalLinks = [
  { label: "Quem Somos" },
  { label: "Política de Privacidade" },
  { label: "Termos de Uso" },
];

const contactInfo = [
  {
    icon: "phone",
    text: "(51) 99453-1889",
  },
  {
    icon: "creci",
    text: "CRECI: 81903",
  },
  {
    icon: "email",
    text: "catiaalexandracorretora@gmail.com",
    href: "mailto:catiaalexandracorretora@gmail.com",
  },
];

export const FooterSection = (): JSX.Element => {
  return (
    <footer className="relative w-full bg-[linear-gradient(90deg,rgba(164,0,0,1)_0%,rgba(110,0,0,1)_74%,rgba(62,0,0,1)_100%)]">
      <div className="container mx-auto px-[30px] py-12">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-6">
          <div className="lg:col-span-1 flex items-start">
            <img
              className="w-[282px] h-[141px]"
              alt="Branco horizontal"
              src="https://c.animaapp.com/mht8rhtrvso9Rd/img/branco-horizontal.svg"
            />
          </div>

          <nav className="flex flex-col gap-3">
            <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-[22px] tracking-[0] leading-[22.0px]">
              NAVEGAÇÃO
            </h3>
            <ul className="flex flex-col gap-2.5">
              {navigationLinks.map((link, index) => (
                <li key={index} className="flex items-start gap-[5px]">
                  <span className="mt-2 w-[5px] h-[5px] bg-white rounded-[2.5px] flex-shrink-0" />
                  <a className="[font-family:'Roboto',Helvetica] font-normal text-white text-lg tracking-[0] leading-[18.0px] hover:underline cursor-pointer">
                    {link.label}
                  </a>
                </li>
              ))}
            </ul>
          </nav>

          <div className="flex flex-col gap-2.5">
            <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-[22px] tracking-[0] leading-[22.0px]">
              ATENDIMENTO
            </h3>
            <div className="flex flex-col gap-2.5">
              <div className="flex items-start gap-2.5">
                <img
                  className="mt-0.5 w-[17px] h-[17px] flex-shrink-0"
                  alt="Phone"
                  src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-25.svg"
                />
                <span className="[font-family:'Roboto',Helvetica] font-normal text-white text-lg tracking-[0] leading-[18.0px]">
                  (51) 99453-1889
                </span>
              </div>

              <div className="flex items-start gap-2.5">
                <img
                  className="mt-[3px] w-[17px] h-[15px] flex-shrink-0"
                  alt="CRECI"
                  src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-20.svg"
                />
                <span className="[font-family:'Roboto',Helvetica] font-normal text-white text-lg tracking-[0] leading-[18.0px]">
                  CRECI: 81903
                </span>
              </div>

              <div className="flex items-start gap-2.5">
                <img
                  className="mt-1 w-[17px] h-3.5 flex-shrink-0"
                  alt="Email"
                  src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-31.svg"
                />
                <a
                  className="[font-family:'Roboto',Helvetica] font-normal text-white text-lg tracking-[0] leading-[18.0px] hover:underline"
                  href="mailto:catiaalexandracorretora@gmail.com"
                  rel="noopener noreferrer"
                  target="_blank"
                >
                  catiaalexandracorretora@gmail.com
                </a>
              </div>
            </div>
          </div>

          <div className="flex flex-col gap-[15px]">
            <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-[22px] tracking-[0] leading-[22.0px]">
              REDES SOCIAS
            </h3>
            <img
              className="w-[110px] h-[30px]"
              alt="Social media icons"
              src="https://c.animaapp.com/mht8rhtrvso9Rd/img/frame-86.svg"
            />
          </div>

          <nav className="flex flex-col gap-3">
            <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-[22px] tracking-[0] leading-[22.0px]">
              INSTITUCIONAL
            </h3>
            <ul className="flex flex-col gap-2.5">
              {institutionalLinks.map((link, index) => (
                <li key={index} className="flex items-start gap-[5px]">
                  <span className="mt-2 w-[5px] h-[5px] bg-white rounded-[2.5px] flex-shrink-0" />
                  <a className="[font-family:'Roboto',Helvetica] font-normal text-white text-lg tracking-[0] leading-[18.0px] hover:underline cursor-pointer">
                    {link.label}
                  </a>
                </li>
              ))}
            </ul>
          </nav>
        </div>

        <div className="mt-[69px] pt-[15px] border-t border-white/20">
          <div className="flex flex-col md:flex-row justify-between items-center gap-4">
            <div className="flex items-center gap-2">
              <img
                className="w-[19px] h-[19px]"
                alt="Copyright"
                src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-28.svg"
              />
              <p className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-sm tracking-[0] leading-[14.0px]">
                2025 CÁTIA ALEXANDRA CORRETORA. TODOS OS DIREITOS RESERVADOS.
              </p>
            </div>
            <p className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-sm tracking-[0] leading-[14.0px]">
              FEITO COM AMOR PARA FACILITAR SUA BUSCA.
            </p>
          </div>
        </div>
      </div>
    </footer>
  );
};
