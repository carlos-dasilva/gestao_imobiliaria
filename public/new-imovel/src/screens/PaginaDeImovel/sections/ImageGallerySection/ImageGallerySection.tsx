import React from "react";

const navigationItems = [
  { label: "Home", active: true },
  { label: "Imóveis", active: false },
  { label: "Quem Somos", active: false },
  { label: "Como Funciona", active: false },
  { label: "Conteúdo", active: false },
  { label: "Contato", active: false },
];

export const ImageGallerySection = (): JSX.Element => {
  return (
    <header className="relative w-full h-[117px] bg-[linear-gradient(90deg,rgba(189,1,0,1)_0%,rgba(154,8,7,1)_68%,rgba(110,16,16,1)_100%)]">
      <div className="container mx-auto h-full flex items-center justify-between px-8">
        <img
          className="w-[356px] h-[55px] translate-y-[-1rem] animate-fade-in opacity-0"
          alt="Colorido branco"
          src="https://c.animaapp.com/mht9bn8iNrOJ7D/img/colorido-branco-vertical.svg"
        />

        <nav className="flex flex-col items-end gap-[3px] translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms]">
          <ul className="flex items-center gap-[25px]">
            {navigationItems.map((item, index) => (
              <li key={index}>
                <a
                  href="#"
                  className="[font-family:'Roboto',Helvetica] font-normal text-white text-xl tracking-[0] leading-normal whitespace-nowrap transition-opacity hover:opacity-80"
                >
                  {item.label}
                </a>
              </li>
            ))}
          </ul>

          <img
            className="w-[66px] h-0.5 mr-[608px]"
            alt="Line"
            src="https://c.animaapp.com/mht9bn8iNrOJ7D/img/line-1.svg"
          />
        </nav>
      </div>
    </header>
  );
};
